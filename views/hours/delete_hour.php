<?php

include '../../classes/database.php';

session_start();

$db = new Database();
$db->delete_hour($_GET['hour_id']);

header('Location: ../../views/hours/index.php');