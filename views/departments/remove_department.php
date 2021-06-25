<?php

require_once '../../classes/database.php';

$db = new Database();

$db->delete_department($_GET['department_id']);

header('Location: /views/departments/index.php');
