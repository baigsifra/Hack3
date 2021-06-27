<?php
  session_start();
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Hack3</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-3.6.0.js"></script>
  </head>
  <body>
    <header>
      <nav>
        <ul class="nav-bar">
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php">About Us</a></li>
          <?php
            if (isset($_SESSION["useremail"])) {
              if ($_SESSION["usertype"] == "userp") {
                echo '<li><a href="link.php">Link Babysitter</a></li>';
              }
              if ($_SESSION["linked"] == "active") {
                echo '<li><a href="reports.php">Reports</a></li>';
              }
              echo '<li><a href="extra.php">Extra Tab</a></li>';
              echo '<li><a href="includes/logout.inc.php">Log Out</a></li>';
            } else {
              echo '<li><a href="signup.php">Sign Up</a></li>';
              echo '<li><a href="login.php">Log In</a></li>';
            }
           ?>
        </ul>
      </nav>
    </header>
