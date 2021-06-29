<?php

include $_SERVER['DOCUMENT_ROOT'] . '/classes/database.php';

$db = new Database();
$db->update_user($_POST['id'], $_POST['type_id'], $_POST['username'], $_POST['email'], $_POST['password']);

header('Location: ../views/users/index.php');
