<?php
    session_start();
    require_once ('user.php');
    
    $json = file_get_contents('../data/data.json');
    $jsonArr = json_decode($json, true);
    
    $s = 'jimk5';

    $password = trim($_POST['password']);
    $password = htmlspecialchars($password);
    $password = md5($password.$s);
    $new_password = trim($_POST['new_password']);
    $new_password = htmlspecialchars($new_password);
    $confirm_password = trim($_POST['confirm_password']);
    $confirm_password = htmlspecialchars($confirm_password);


    $pattern_letters = '/[a-zA-Z]/';
    $pattern_numbers = '/[0-9]/';

    $errors = [];

    
    if($new_password !== $confirm_password) {
        $errors[] = [
            "status" => false,
            "type" => 'confirm_password',
            "message" => 'Пароли не совпадают'
        ];
    }

    if(strlen($new_password) < 6 || !preg_match($pattern_numbers, $new_password) || !preg_match($pattern_letters, $new_password)) {
        $errors[] = [
            "status" => false,
            "type" => 'password',
            "message" => 'Пароль должен состоять из букв латинского алфавита и цифр и содержать не менее 6 символов'
        ];
    }

    //echo $password;
    if($_SESSION["user"]['password'] !== $password){
        $errors[] = [
            "status" => false,
            "type" => 'old_password',
            "message" => 'Неверный пароль'
        ];
        
    }

    if(!empty($errors)){
        echo json_encode($errors);
        die();
    } else {
        $user = new User();
        $user->updatePassword($new_password, $jsonArr);

    } 
 
