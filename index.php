<?php
    session_start();

    if(isset ($_SESSION['user'])){
        header('Location: profile.php');
    }

?>;

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.png" type="image/png">
    <title>Тестовое задание: форма авторизации</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <form class="form" >
            <h2 class="title">Форма авторизации</h2> 
            <input class="input input-login" name="login" type="text" placeholder="Ваше имя" required>
            <p class="error-login none error">message error</p>   
            <input  class="input input-password" name="password" type="password" placeholder="Ваш пароль" required>
            <p class="error-password none error">message error</p>   
            <p class="message none error">message error</p>   
            <input class="input-submit" type="submit" value="Войти">
            <p>У вас нет аккаунта? <a href="/register.php">Зарегистрируйтесь</a></p>

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