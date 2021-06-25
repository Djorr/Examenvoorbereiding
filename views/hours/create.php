<?php

require_once '../../classes/database.php';

$db = new Database();
$users_overview = $db->users_overview();

$departments_overview = $db->deparments_overview();

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$starts_at = $_POST['start_date'] . ' ' . $_POST['start_time'];
	$ends_at = $_POST['end_date'] . ' ' . $_POST['end_time'];

	$db->insert_hour($_POST['user_id'], $_POST['department_id'], $starts_at, $ends_at);

	header('Location: ../hours');
}

?>

<form method="post">
	<label for="user_id">Gebruiker:</label><br>
	<select id="user_id" name="user_id" autofocus>
		<?php foreach ($users_overview as $user) { ?>
		<option value="<?= $user['id'] ?>"><?= $user['username'] . ' - ' . $user['email'] ?></option>
		<?php } ?>
	</select><br>


	<label for="department_id">Department:</label><br>
	<select id="department_id" name="department_id" autofocus>
		<?php foreach ($departments_overview as $department) { ?>
		<option value="<?= $department['id'] ?>"><?= $department['name'] . ' - ' . $department['post_code'] ?></option>
		<?php } ?>
	</select><br>

	<label for="start_date">Van:</label><br>
	<input id="start_date" type="date" name="start_date" value="<?= date('Y-m-d') ?>" required>
	<input type="time" name="start_time" value="<?= date('H:i') ?>" required><br>

	<label for="end_date">Tot:</label><br>
	<input id="end_date" type="date" name="end_date" value="<?= date('Y-m-d') ?>" required>
	<input type="time" name="end_time" value="<?= date('H:i') ?>" required><br>

	<input type="submit" value="Toevoegen">
</form>
