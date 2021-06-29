<?php

include $_SERVER['DOCUMENT_ROOT'] . '/classes/database.php';

$db = new Database();

$db->create_admin();

header('Location: /index.php');

?>
