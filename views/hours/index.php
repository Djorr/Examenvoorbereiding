<?php

require_once '../../partials/header.php';

if (array_key_exists('is_admin', $_SESSION) && $_SESSION['is_admin']) {
	$hours_overview = $db->hours_overview();

?>

<table class="table table-bordered">
	<tr>
		<th>Gebruiker</th>
		<th>Afdeling</th>
		<th>Begint op</th>
		<th>Eindigt op</th>
		<th>Created at</th>
		<th>Updated at</th>
        <th colspan="2">Beheer</th>
	</tr>
	<?php foreach ($hours_overview as $hour) { ?>
	<tr>
		<td><?= $hour['user'] ?></td>
		<td><?= $hour['department'] ?></td>
		<td><?= $hour['starts_at'] ?></td>
		<td><?= $hour['ends_at'] ?></td>
		<td><?= $hour['created_at'] ?></td>
		<td><?= $hour['updated_at'] ?></td>
        <td><a href="/views/hours/edit.php?hour_id=<?= $hour['id'] ?>&user_name=<?= $hour['user'] ?>&department_name=<?= $hour['department'] ?>">Bewerken</a></td>
        <td><a href="/views/hours/delete_hour.php?hour_id=<?= $hour['id'] ?>">Verwijderen</a></td>
	</tr>
	<?php }	// endforeach ?>
</table>

<br>
<a class="button" href="../../views/hours/create.php">Toevoegen</a>

<?php

} //endif admin

?>

<?= require_once '../../partials/footer.php'; ?>