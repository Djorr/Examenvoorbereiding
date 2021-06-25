<?php

include 'database.php';

$db = new Database();

// $_POST voor method="post"; de andere method is "get", raad maar eens wat je daarvoor gebruikt 😉
$db->login($_POST['username'], $_POST['password']);
