<?php

include '../../classes/database.php';

$db = new Database();

session_start();

?>

<!DOCTYPE html>
<html>
<head lang="nl">
    <meta charset="utf-8" />
    <title>Examenvoorbereiding</title>
    
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Examenvoorbereiding opdracht</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="/views/users/">Gebruikers</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/views/hours/">Hours</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/views/department_user/">Departments</a>
      </li>
    </ul>
  </div>
</nav>
