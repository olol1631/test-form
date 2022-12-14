<?php
    session_start();

    if(!$_SESSION['user']){
        header('Location: / ');
    }
?>;

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.png" type="image/png">
    <title>Тестовое задание: личный кабинет</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="content">
            <p>Здравствуйте, <?php echo $_SESSION["user"]['name']?></p>
            <p>Ваш логин: <?php echo $_SESSION["user"]['login']?></p>
            <p>Ваш email: <?php echo $_SESSION["user"]['email']?></p>
            <a class="exit" href="vendor/logout.php">Выйти</a>
            <br>
            <a class="link" href="change-profile.php">Редактировать</a> |
            <a class="link" href="change-password.php">Изменить пароль</a> |
            <a class="link" href="vendor/delete.php">Удалить</a> 
            
        </div>
    </div>


</body>
</html>