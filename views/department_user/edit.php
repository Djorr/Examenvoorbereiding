<?php

require_once '../../partials/header.php';

$department = $db->deparments_overview();
$user = $db->get_user($_GET['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$db->update_user_department($_POST['department_id'], $_POST['user_id']);

	header('Location: /views/department_user/');
}

?>

<body>
    <div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" method="post">
                            <h3 class="text-center text-info">Department wijzigen</h3>
                            <div class="form-group">
                                <label for="department" class="text-info" >Department:</label><br>
                                <select name="department_id">
                                    <?php foreach ($department as $depart) { ?>
                                        <option value="<?= $depart['name'] ?>"><?= $depart['name'] . ' - ' . $depart['post_code'] . ' - ' . $depart['city'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="user" class="text-info" >Gebruiker:</label><br>
                                <input type="text" name="user_id" value="<?= $user['username'] . ' - ' . $user['email'] ?>" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Update profiel">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="/views/users/index.php" class="text-info">Terug naar overview</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- Het HTML-formulier die je al had laat je hier. -->

<?php require_once '../../partials/footer.php'; ?>