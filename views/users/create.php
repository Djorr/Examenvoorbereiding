<?php

session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] .  '/classes/database.php';
    $db = new Database();
$user_types = $db->get_user_types();

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{

    $db->create_user($_POST['type_id'], $_POST['username'], $_POST['email'], $_POST['password']);

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
        <h3 class="text-center text-white pt-5">Gebruiker aanmaken</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" method="post">
                            <h3 class="text-center text-info">Gebruiker aanmaken</h3>

                            <div class="form-group">
                                <label for="type_id" class="text-info" >Type:</label><br>
                                <select name="type_id">
                                    <?php foreach ($user_types as $type) { ?>
                                        <option value="<?= $type['id'] ?>" <?= $type['id'] === '2' ? 'selected' : '' ?>><?= $type['type'] ?></option>
                                    <?php } // endforeach user_types ?>
                            </select> <br />

                            <div class="form-group">
                                <label for="username" class="text-info" >Gebruikersnaam:</label><br>
                                <input type="text" name="username" placeholder="Gebruikersnaam" value="" class="form-control" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="email" class="text-info" >Email:</label><br>
                                <input type="email" name="email" placeholder="E-mailadres" value="" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info" >Wachtwoord:</label><br>
                                <input type="password" name="password" placeholder="Wachtwoord" class="form-control" minlength="8" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Gebruiker aanmaken">
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