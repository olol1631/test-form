<?php
    session_start();

    $json = file_get_contents('../data/data.json');
    $jsonArr = json_decode($json, true);

    $name = trim($_POST['name']);
    $name = htmlspecialchars($name);
    $login = trim($_POST['login']);
    $login = htmlspecialchars($login);
    $email = $_POST['email'];
    $password = trim($_POST['password']);
    $password = htmlspecialchars($password);
    $confirm_password = trim($_POST['confirm_password']);
    $confirm_password = htmlspecialchars($confirm_password);

    $pattern_name = '/[^а-яА-ЯёЁa-zA-Z]/';
    $pattern_letters = '/[a-zA-Z]/';
    $pattern_numbers = '/[0-9]/';
    $pattern_email = '/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/';

    $errors = [];

    if($password !== $confirm_password) {
        $errors[] = [
            "status" => false,
            "type" => 'confirm_password',
            "message" => 'Пароли не совпадают'
        ];
    }

    if(strlen($password) < 6 || !preg_match($pattern_numbers, $password) || !preg_match($pattern_letters, $password)) {
        $errors[] = [
            "status" => false,
            "type" => 'password',
            "message" => 'Пароль должен состоять из букв латинского алфавита и цифр и содержать не менее 6 символов'
        ];
    }

    if(mb_strlen($name) < 2) {
        $errors[] = [
            "status" => false,
            "type" => 'name',
            "message" => 'Имя пользователя может содержать не менее 2 символов'
        ];
    }
    if(preg_match($pattern_name, $name)){
        $errors[] = [
            "status" => false,
            "type" => 'name',
            "message" => 'Имя пользователя может состоять только из букв латинского алфавита'
        ];
    }

    if($login === ''){
        $errors[] = [
            "status" => false,
            "type" => 'login',
            "message" => 'Заполните поле'
        ];
    }

    if(!preg_match($pattern_email, $email)){
        $errors[] = [
            "status" => false,
            "type" => 'email',
            "message" => 'Введите корректный email'
        ];
    }



    //Проверяем есть ли такой логин и email в БД
    for($i = 0; $i < count($jsonArr); $i++){
        if($jsonArr[$i]['login'] === $login){
            $errors[] = [
                "status" => false,
                "type" => 'login',
                "message" => 'Пользователь с логином ' . $login . ' уже существует'
            ];
            
        } 
        if($jsonArr[$i]['email'] === $email){
            $errors[] = [
                "status" => false,
                "type" => 'email',
                "message" => 'Пользователь с email '. $email . ' уже существует'
            ];

        }
    }

    if(!empty($errors)){
        echo json_encode($errors);
        die();
    }

    //Проверяем есть ли ошибки в полях и совпадают ли пароли
    if(empty($errors) && $password === $confirm_password){
        $data = array();
        $s = 'jimk5';
        
        $data['name'] = $name;
        $data['login'] = $login;
        $data['email'] = $email;
        $data['password'] = md5($password.$s);
        
        //Запись в файл data.json
        if (file_exists('../data/data.json')){
            $json = file_get_contents('../data/data.json');
            $jsonArray = json_decode($json, true);
            $jsonArray[] = $data;
            $jsonData = json_encode($jsonArray);
            file_put_contents('../data/data.json', $jsonData);
        } else{
            $jsonArray[] = $data;
            $jsonData = json_encode($jsonArray);
            file_put_contents('../data/data.json', $jsonData);
        }

        $response = [
            "status" => true
        ];
        echo json_encode($response);


    } 
    