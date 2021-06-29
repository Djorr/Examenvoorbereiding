<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/partials/header.php';

$user = $db->get_user(isset($_SESSION['logged_in_as']));

?>

<br>
<br>

<div class="container">
    <div class="main-body">
        <div class="row gutters-sm">
          <div class="col-md-4 mb-3">
            <div class="card">
              <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                  <div class="mt-3">
                    <h4><?= $user['username'] ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card mb-3">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Volledige naam</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <?= $user['firstname'] . ' ' . $user['tussenvoegsel'] . ' ' . $user['lastname']?> 
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Email</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <?= $user['email'] ?>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Telefoonnummer</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <?= '+' . $user['phonenumber'] ?>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-12">
                    <a class="btn btn-info " href="../views/users/edit.php?user_id=<?= $user['id'] ?>">Bewerk gebruiker</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<br>
<a class="button" href="views/users/create.php">Toevoegen</a>
<a href="/exports/user_overview.php">Downloaden als spreadsheet</a>

<?= require_once $_SERVER['DOCUMENT_ROOT'] . '/partials/footer.php'; ?>
