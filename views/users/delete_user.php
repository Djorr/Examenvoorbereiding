<?php

include '../../classes/database.php';

session_start();

$db = new Database();
$db->delete_user($_GET['user_id']);

header('Location: ../../views/users/index.php');