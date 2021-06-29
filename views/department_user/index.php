<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/partials/header.php';

if ($_SESSION['is_admin']) {
	$department_user = $db->department_user_overview();

?>
<table class="table table-bordered">
    <thead>
      <tr>
				<th>Afdeling</th>
				<th>Gebruikersnaam</th>
				<th colspan="2">Beheer</th>
      </tr>
    </thead>
    <tbody>
		<?php foreach ($department_user as $entry) { ?>
		<tr>
			<td><?= $entry['department_name'] ?></td>
			<td><?= $entry['username'] ?></td>
			<td><a href="/views/department_user/edit.php?department_id=<?= $entry['id'] ?>&user_id=<?= $entry['user_id'] ?>">Bewerken</a></td>
			<td><a href="/views/department_user/remove_user_from_department.php?department_id=<?= $entry['id'] ?>&user_id=<?= $entry['user_id'] ?>">Verwijderen</a></td>
		</tr>
		<?php } //endforeach department_user ?>
	</tbody>
</table>

<br>
<a class="button" href="../department_user/add_user.php">Toevoegen</a>

<?php

} //endif admin

?>

<?= require_once $_SERVER['DOCUMENT_ROOT'] . '/partials/footer.php'; ?>