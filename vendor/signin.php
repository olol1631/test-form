<?php
    session_start();
    
    $json = file_get_contents('../data/data.json');
    $jsonArr = json_decode($json, true);

    $s = 'jimk5';

    $login = trim($_POST['login']);
    $login = htmlspecialchars($login);
    $password = trim($_POST['password']);
    $password = htmlspecialchars($password);
    $password = md5($password.$s);

    //Проверяем есть ли такой логин и пароль в БД
    $search = array();
    for($i = 0; $i < count($jsonArr); $i++){
        if($jsonArr[$i]['login'] === $login && $jsonArr[$i]['password'] === $password){

            $search[] = $i;
        }
    }
    
    if(count($search)>0){
        $searchIndex = $search[0]; 
        $_SESSION["user"] = [
            "name" => $jsonArr[$searchIndex]['name'],
            "login" => $jsonArr[$searchIndex]['login'],
            "email" => $jsonArr[$searchIndex]['email'],
            "password" => $jsonArr[$searchIndex]['password']

        ];

        $response = [
            "status" => true
        ];
        echo json_encode($response);

    } else {
        $response = [
            "status" => false,
            "message" => 'Неверный логин или пароль'
        ];

        echo json_encode($response);

    };
    
?>
