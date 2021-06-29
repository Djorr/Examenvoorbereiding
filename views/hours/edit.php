<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/partials/header.php';

$hour = $db->get_hour($_GET['hour_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{

    $starts_at = $_POST['start_date'] . ' ' . $_POST['start_time'];
    $ends_at = $_POST['end_date'] . ' ' . $_POST['end_time'];

	$db->update_hour($_GET['hour_id'], $starts_at, $ends_at);

	header('Location: /views/hours/');
}

?>

<form method="post">
    <div class="form-group">
        <label for="afdeling" class="text-info" >Gebruiker:</label><br>
        <input type="text" name="afdeling" value="<?= $_GET['user_name'] ?>" class="form-control" readonly>
    </div>
    <div class="form-group">
        <label for="afdeling" class="text-info" >Afdeling:</label><br>
        <input type="text" name="afdeling" value="<?= $_GET['department_name'] ?>" class="form-control" readonly>
    </div>

        <label for="start_date">Van:</label><br>
    <input id="start_date" type="date" name="start_date" value="<?= date('Y-m-d') ?>" required>
    <input type="time" name="start_time" value="<?= date('H:i') ?>" required><br>

    <label for="end_date">Tot:</label><br>
    <input id="end_date" type="date" name="end_date" value="<?= date('Y-m-d') ?>" required>
    <input type="time" name="end_time" value="<?= date('H:i') ?>" required><br>

    <input type="submit" value="Update">
</form>

<!-- Het HTML-formulier die je al had laat je hier. -->

<?php require_once '../../partials/footer.php'; ?>