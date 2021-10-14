<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/session.php';



?>
<!DOCTYPE html>
<html>
  <head>
    <title>Farewell 2020</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta version="v.1.0.1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.6.0/jq-3.6.0/jszip-2.5.0/dt-1.11.3/af-2.3.7/b-2.0.1/b-colvis-2.0.1/b-html5-2.0.1/b-print-2.0.1/cr-1.5.4/date-1.1.1/fc-4.0.0/fh-3.2.0/kt-2.6.4/r-2.2.9/rg-1.1.3/rr-1.2.8/sc-2.0.5/sb-1.2.2/sp-1.4.0/sl-1.3.3/datatables.min.css"/>
 
<link rel="icon" href="favicon.ico" sizes="16x16">
<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&family=Balsamiq+Sans:ital,wght@0,400;1,400;1,700&family=Comfortaa:wght@400;700&family=Kalam:wght@300;400;700&family=Lobster&family=Pacifico&display=swap" rel="stylesheet">
<link href="library/fontawsome/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
</head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #dbad42;">
  <a class="navbar-brand" href="#">Farewell Himsur21</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="/">Register <span class="sr-only">(current)</span></a>
      </li>
      <?php
        try {
            $session = SessionManager::getCurrentSession();
        
      ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Crew Area
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="scan">Check-In</a>
          <a class="dropdown-item" href="rekap">Rekap</a>
          <a class="dropdown-item" href="logout">Logout</a>
        </div>
      </li>
      <?php
        } catch (Exception $exception) {
        ?>
        <li class="nav-item">
            <a class="nav-link" href="#" id="btnlogin">Crew Login</a>
        </li>
        <?php
        }
      ?>
      </ul>
    </div>

</nav>