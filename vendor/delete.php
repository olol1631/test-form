<?php
session_start();

$json = file_get_contents('../data/data.json');
$jsonArr = json_decode($json, true);

for($i = 0; $i < count($jsonArr); $i++){
    if($_SESSION["user"]["login"] === $jsonArr[$i]["login"]){
        unset($jsonArr[$i]);        
    }
}

//Записать обновленные данные в файл data.json
$jsonData = json_encode($jsonArr);
file_put_contents('../data/data.json', $jsonData);

unset($_SESSION['user']);
header('Location: ../index.php');