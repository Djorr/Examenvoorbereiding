<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/database.php';

$db = new Database();
$user_types = $db->get_user_types();
$user = $db->get_user($_GET['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $db->update_user($_POST['id'], $_POST['type_id'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['firstname'], $_POST['tussenvoegsel'], $_POST['lastname'], $_POST['phonenumber']);

    header('Location: /views/users/index.php');
}

?>

<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" method="post">
                            <h3 class="text-center text-info">Gebruiker wijzigen</h3>
                            <div class="form-group">
                                <label for="username" class="text-info" >Type:</label><br>

                               	<input type="hidden" name="id" value="<?= $_GET['user_id'] ?>">
								<select name="type_id">
									<?php foreach ($user_types as $type) { ?>
										<option value="<?= $type['id'] ?>" <?php if ($type['id'] === $user['type_id']) echo 'selected' ?>><?= $type['type'] ?></option>
									<?php } ?>
								</select>
                            </div>
                            <div class="form-group">
                                <label for="username" class="text-info" >Gebruikersnaam:</label><br>
                                <input type="text" name="username" placeholder="Gebruikersnaam" value="<?= $user['username'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email" class="text-info" >Email:</label><br>
                                <input type="text" name="email" placeholder="E-mailadres" value="<?= $user['email'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info" >Wachtwoord:</label><br>
                                <input type="password" name="password" placeholder="Wachtwoord" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="firstname" class="text-info" >Voornaam:</label><br>
                                <input type="text" name="firstname" placeholder="Voornaam" value="<?= $user['firstname'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="tussenvoegsel" class="text-info" >Tussenvoegsel:</label><br>
                                <input type="text" name="tussenvoegsel" placeholder="Tussenvoegsel" value="<?= $user['tussenvoegsel'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="lastname" class="text-info" >Achternaam:</label><br>
                                <input type="text" name="lastname" placeholder="Achternaam" value="<?= $user['lastname'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="phonenumber" class="text-info" >Telefoonnummer:</label><br>
                                <input type="number" name="phonenumber" placeholder="Telefoonnummer" value="<?= $user['phonenumber'] ?>" class="form-control">
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