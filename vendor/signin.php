<?php
    session_start();
    require_once ('user.php');
    
    $json = file_get_contents('../data/data.json');
    $jsonArr = json_decode($json, true);

    $s = 'jimk5';

    $login = trim($_POST['login']);
    $login = htmlspecialchars($login);
    $password = trim($_POST['password']);
    $password = htmlspecialchars($password);
    $password = md5($password.$s);


    $user = new User();
    $user->signIn($login, $password, $jsonArr);
    
?>
