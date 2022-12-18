<?php
    session_start();

    $json = file_get_contents('../data/data.json');
    $jsonArr = json_decode($json, true);
    
    $name = trim($_POST['name']);
    $name = htmlspecialchars($name);
    $login = trim($_POST['login']);
    $login = htmlspecialchars($login);
    $email = $_POST['email'];

    $pattern_name = '/[^а-яА-ЯёЁa-zA-Z]/';
    $pattern_email = '/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/';

    $errors = [];


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
        if($_SESSION["user"]["login"] !== $login && $jsonArr[$i]['login'] === $login){
            $errors[] = [
                "status" => false,
                "type" => 'login',
                "message" => 'Пользователь с логином ' . $login . ' уже существует'
            ];
            
        } 
        if($_SESSION["user"]["email"] !== $email && $jsonArr[$i]['email'] === $email){
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

    //Проверяем есть ли ошибки
    if(empty($errors)){
        $data = array();
        
        $data['name'] = $name;
        $data['login'] = $login;
        $data['email'] = $email;
        
        //Внести изменения 
        for($i = 0; $i < count($jsonArr); $i++){
            if($jsonArr[$i]['login'] === $_SESSION["user"]['login']){
    
                $jsonArr[$i]['name'] = $name;
                $jsonArr[$i]['login'] = $login;
                $jsonArr[$i]['email'] = $email;
            }
        }

        //Записать новые данные в файл data.json
        $jsonData = json_encode($jsonArr);
        file_put_contents('../data/data.json', $jsonData);
        
        $_SESSION["user"]['name'] = $name;
        $_SESSION["user"]['login'] = $login;
        $_SESSION["user"]['email'] = $email;

        $response = [
            "status" => true
        ];
        echo json_encode($response);


    } 