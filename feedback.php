<?php
    $to = 'ol.ol1631@gmail.com';
    $from = trim($_POST['email']);
    $subject = 'Сообщение с сайта';
    $message = htmlspecialchars($_POST['message']);
    $message = urldecode($message);
    $message = trim($message);

    $headers = "From: $from" . "\r\n" .
    "Reply-To: $from" . "\r\n" .
    "X-Mailer: PHP/" . phpversion();

    if(mail($to, $subject, $message, $headers)){
        echo 'Сообщение отправлено';
    } else{
        echo 'Сообщение не отправлено';
    }
?>