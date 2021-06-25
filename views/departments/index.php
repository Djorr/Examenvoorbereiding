<?php

require_once '../../partials/header.php';

if ($_SESSION['is_admin']) {
	$departments = $db->deparments_overview();

?>
<table class="table table-bordered">
    <thead>
      <tr>
				<th>Afdeling</th>
				<th>Postcode</th>
				<th>Stad</th>
				<th>Straatnaam</th>
				<th>Huisnummer</th>
				<th>Gemaakt op</th>
				<th>Geupdate op</th>
				<th colspan="2">Beheer</th>
      </tr>
    </thead>
    <tbody>
		<?php foreach ($departments as $entry) { ?>
		<tr>
			<td><?= $entry['name'] ?></td>
			<td><?= $entry['post_code'] ?></td>
			<td><?= $entry['city'] ?></td>
			<td><?= $entry['street'] ?></td>
			<td><?= $entry['number'] ?></td>
			<td><?= $entry['created_at'] ?></td>
			<td><?= $entry['updated_at'] ?></td>
			<td><a href="/views/departments/edit_department.php?department_id=<?= $entry['id'] ?>">Bewerken</a></td>
			<td><a href="/views/departments/remove_department.php?department_id=<?= $entry['id'] ?>">Verwijderen</a></td>
		</tr>
		<?php } //endforeach department_user ?>
	</tbody>
</table>

<br>
<a class="button" href="../departments/add_department.php">Toevoegen</a>

<?php

} //endif admin

?>

<?= require_once '../../partials/footer.php'; ?>