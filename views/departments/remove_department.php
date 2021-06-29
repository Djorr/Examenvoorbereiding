<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/database.php';

$db = new Database();

$db->delete_department($_GET['department_id']);

header('Location: /views/departments/index.php');
