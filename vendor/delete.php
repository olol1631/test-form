<?php
session_start();
require_once ('user.php');

$json = file_get_contents('../data/data.json');
$jsonArr = json_decode($json, true);

$user = new User();
$user->delete($jsonArr);
