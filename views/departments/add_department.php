<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/partials/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' )
{
	$db->add_department($_POST['afdeling'], $_POST['postcode'], $_POST['stad'], $_POST['straatnaam'], $_POST['huisnummer']);

	header('Location: /views/departments/index.php');
}

?>

<body>
    <div id="login">
        <h3 class="text-center text-white pt-5">Afdeling aanmaken</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" method="post">
                            <h3 class="text-center text-info">Afdeling aanmaken</h3>
                            <div class="form-group">
                                <label for="afdeling" class="text-info" >Afdeling:</label><br>
                                <input type="text" name="afdeling" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="postcode" class="text-info" >Postcode:</label><br>
                                <input type="text" name="postcode" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="stad" class="text-info" >Stad:</label><br>
                                <input type="text" name="stad" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="straatnaam" class="text-info" >Straatnaam:</label><br>
                                <input type="text" name="straatnaam" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="huisnummer" class="text-info" >Huisnummer:</label><br>
                                <input type="text" name="huisnummer" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Afdeling aanmaken">
                            </div>
                            <div id="register-link" class="text-right">
                                <a href="/views/departments/index.php" class="text-info">Terug naar overview</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php require_once '../../partials/footer.php'; ?>
