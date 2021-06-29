<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/partials/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
  $db->create_new_user(2,
    $_POST['gebruikersnaam'],
    $_POST['email'],
    $_POST['wachtwoord']
  );
}
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<body>
    <div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Registreren</h3>

                            <div class="form-group">
                                <label for="email" class="text-info" >Email:</label><br>
                                <input type="email" name="email" placeholder="Email" value="<?php echo isset($_POST["email"]) ? htmlentities($_POST["email"]) : ''; ?>" required class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="text" class="text-info" >Gebruikersnaam:</label><br>
                                <input type="text" name="gebruikersnaam" placeholder="Gebruikersnaam" value="<?php echo isset($_POST["uname"]) ? htmlentities($_POST["uname"]) : ''; ?>" required class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="password" class="text-info" >Wachtwoord:</label><br>
                                <input type="password" name="wachtwoord" placeholder="Wachtwoord" required  class="form-control">
                            </div>

                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Registreren">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="/inloggen/index.php">Ik heb al een account. Login!</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?= require_once $_SERVER['DOCUMENT_ROOT'] . '/partials/footer.php'; ?>