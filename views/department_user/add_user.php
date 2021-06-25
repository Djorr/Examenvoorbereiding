<?php

require_once '../../partials/header.php';

$users = $db->users_overview();
$departments = $db->deparments_overview();

if ($_SERVER['REQUEST_METHOD'] === 'POST' )
{
	$db->add_user_to_department($_POST['department_id'], $_POST['user_id']);

	header('Location: /views/department_user/index.php');
}

?>


<form method="post">

	<select name="department_id">
		<?php foreach ($departments as $department) { ?>
		<option value="<?= $department['id'] ?>"><?= $department['name']?></option>
		<?php } ?>
	</select>

	<select name="user_id">
		<?php foreach ($users as $user) { ?>
		<option value="<?= $user['id'] ?>"><?= $user['username'] . ' - ' . $user['email'] ?></option>
		<?php } ?>
	</select>

	<input type="submit" value="Toevoegen" />
</form>

<?php require_once '../../partials/footer.php'; ?>
