<?php

include '../classes/database.php';

$db = new Database();

$db->create_admin();

header('Location: /index.php');

?>
