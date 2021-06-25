<?php

require_once '../../partials/header.php';

if ($_SESSION['is_admin']) {
	$users = $db->users_overview();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Examenvoorbereiding</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<a href="../../classes/logout.php">Uitloggen</a>

<table class="table table-bordered">
    <thead>
      <tr>
		<th>Rol</th>
		<th>Gebruikersnaam</th>
		<th>Email</th>
		<th colspan="2">Beheer</th>
      </tr>
    </thead>
    <tbody>
		<?php foreach ($users as $entry) { ?>
		<tr>
			<td><?= $entry['type'] ?></td>
			<td><?= $entry['username'] ?></td>
			<td><?= $entry['email'] ?></td>
			<td><a href="../users/edit.php?user_id=<?= $entry['id'] ?>">Bewerken</a></td>
			<td><a href="../users/delete_user.php?user_id=<?= $entry['id'] ?>">Verwijderen</a></td>
		</tr>
		<?php } //endforeach ?>
	</tbody>
</table>

<br>
<a class="button" href="../users/create.php">Toevoegen</a>
<a href="/exports/user_overview.php">Downloaden als spreadsheet</a>

<?php } //endif ?>

</body>
</html>

<?= require_once '../../partials/footer.php'; ?>
