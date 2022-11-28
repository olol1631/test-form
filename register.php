<?php
    session_start();

    if(isset ($_SESSION['user'])){
        header('Location: profile.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.png" type="image/png">
    <title>Тестовое задание: форма регистрации и авторизации</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <form class="form" action="vendor/signup.php" method="POST">
            <h2 class="title">Форма регистрации</h2> 
            <input class="input input-name" name="name" type="text" placeholder="Ваше имя" minlength="2" required>
            <p class="none error error-name">message error</p>
            <input class="input input-login" name="login" type="text" placeholder="Ваш логин" minlength="2" required>
            <p class="none error error-login">message error</p>
            <input  class="input input-email" name="email" type="email" placeholder="Ваш email" required>
            <p class="none error error-email">message error</p>
            <input class="input input-password" type="password" name="password" placeholder="Введите ваш пароль" minlength="6" required>
            <input class="input input-password" type="password" name="confirm_password" placeholder="Подтвердите ваш пароль" required>
            <p class="error none error-password">message error</p>
            <input class="register-btn" type="submit" value="Зарегистрироваться">
            <p>У вас уже есть аккаунт? <a href="/">Авторизуйтесь</a></p>

        </form>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>