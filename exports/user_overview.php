<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/database.php';

$db = new Database();
$users = $db->users_overview();

// Dat het in een Excel 2007 applicatie moet worden geopend
header('Content-Type: application/vnd.ms-excel');

// Dat het een 'bijlage' is (niet de pagina renderen, dus!) en een bepaalde naam heeft
$fileName = 'Gebruikersoverzicht ' . date('Y-m-d H.i') . '.xls';
header('Content-Disposition: attachment; filename="' . $fileName . '"');

echo " \tRol\tGebruikersnaam\tE-mailadres\n";

foreach ($users as $user)
{
	echo implode("\t", $user);
	echo "\n";
}