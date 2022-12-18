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
    <title>Тестовое задание: изменить пароль</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <form class="form">
            <h2 class="title">Изменить пароль </h2> 
            <input class="input input-password" type="password" name="password" placeholder="Введите ваш пароль" minlength="6" required>
            <p class="error none old-password">message error</p>
            <input class="input input-password" type="password" name="new_password" placeholder="Введите новый пароль" minlength="6" required>
            <p class="error none error-password">message error</p>
            <input class="input input-password" type="password" name="confirm_password" placeholder="Подтвердите новый пароль" required>
            <p class="error none error-confirm">message error</p>
            <button class="update-password">Сохранить изменения</button>
            
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