<?php
    session_start();

    if(!$_SESSION['user']){
        header('Location: / ');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/png">
    <title>Тестовое задание: редактировать данные пользователя</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <form class="form">
            <h2 class="title">Редактировать данные пользователя </h2> 
            <input class="input input-name" name="name" type="text" placeholder="Ваше имя"  minlength="2" required>
            <p class="none error error-name">message error</p>
            <input class="input input-login" name="login" type="text" placeholder="Ваш логин" minlength="2" required>
            <p class="none error error-login">message error</p>
            <input  class="input input-email" name="email" type="text" placeholder="Ваш email" required>
            <p class="none error error-email">message error</p>
            <p class="error none error-confirm">message error</p>
            <button class="update-btn">Сохранить изменения</button>
            
        </form>

    </div>
    <noscript class="noscript">
        <div class="container">
            <p>Невозможно отправить форму с отключенным JavaScript</p>
        </div>
    </noscript>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>