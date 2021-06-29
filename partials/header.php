<?php

include $_SERVER['DOCUMENT_ROOT'] . '/classes/database.php';

$db = new Database();
session_start();

?>

<!DOCTYPE html>
<html>
<head lang="nl">
    <meta charset="utf-8" />
    <title>Examenvoorbereiding</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Examenvoorbereiding opdracht</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { ?>
      <li class="nav-item">
          <a class="nav-link" href="/dashboard/index.php">Home</a>
      </li>
      <?php } else { ?>
      <li class="nav-item">
          <a class="nav-link" href="/">Home</a>
      </li>
      <?php } ?>

      <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == true) { ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Beheerder
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="/views/users/index.php">Gebruikers</a>
          <a class="dropdown-item" href="/views/hours/index.php">Uren loggen</a>
          <a class="dropdown-item" href="/views/departments/index.php">Departementen</a>
          <a class="dropdown-item" href="/views/department_user/index.php">Gebruiker Departementen</a>
        </div>
      </li>
      <?php } ?>
    </ul>

    <ul class="navbar-nav mr-auto">
      <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?= $_SESSION['logged_in_as'] ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="/profile/index.php">Mijn profiel</a>
          <a class="dropdown-item" href="/classes/logout.php">Uitloggen</a>
        </div>
      </li>
      <?php } else { ?>
      <li class="nav-item dropdown ">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Account
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="/inloggen/index.php">Inloggen</a>
          <a class="dropdown-item" href="/registreren/index.php">Registreren</a>
        </div>
      <?php } ?>
    </ul>
  </div>
</nav>
