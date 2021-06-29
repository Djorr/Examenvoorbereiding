<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/partials/header.php';

if ($_SESSION['is_admin']) {
	$users = $db->users_overview();

?>

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
<a class="button" href="views/users/create.php">Toevoegen</a>
<a href="/exports/user_overview.php">Downloaden als spreadsheet</a>

<?php } //endif ?>

<?= require_once $_SERVER['DOCUMENT_ROOT'] . '/partials/footer.php'; ?>
