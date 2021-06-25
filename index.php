<?php

include 'classes/database.php';

$db = new Database();
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{

    $db->login($_POST['username'], $_POST['password']);
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
                            <h3 class="text-center text-info">Inloggen</h3>
                            <div class="form-group">
                                <label for="username" class="text-info" >Username:</label><br>
                                <input type="text" name="username" placeholder="Gebruikernaam" required autofocus class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info" >Password:</label><br>
                                <input type="password" name="password" placeholder="Wachtwoord" required class="form-control">
                            </div>
                            <span><?php echo ((isset($loginError) && $loginError != '') ? $loginError ."<br>" : '')?></span>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Inloggen">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="signup.php" class="text-info">New user? Sign up!</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php

require_once 'partials/footer.php';

?>
