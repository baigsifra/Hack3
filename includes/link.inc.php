<?php

require_once '../global.php';
if (isset($_POST["submit"])) {
  $email = $_POST["email"];

   require_once 'dbh.inc.php';
   require_once 'functions.inc.php';

   if (emptyInputLink($email) !== false) {
     header("location: ../link.php?error=emptyinput");
     exit();
   }

   getInfo($conn, $email);
} else {
   header("location: ../link.php");
   exit();
}
