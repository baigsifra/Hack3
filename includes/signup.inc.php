<?php

if (isset($_POST["submit"])) {

  $firstName = $_POST["fname"];
  $lastName = $_POST["lname"];
  $email = $_POST["email"];
  $pwd = $_POST["pwd"];
  $repeatpwd = $_POST["repeatpwd"];
  $userType = $_POST["user"];

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';

  if (emptyInputSignup($firstName, $lastName, $email, $pwd, $repeatpwd, $userType) !== false) {
    header("location: ../signup.php?error=emptyinput");
    exit();
  }
  if (invalidEmail($email) !== false) {
    header("location: ../signup.php?error=invalidemail");
    exit();
  }
  if (pwdMatch($pwd, $repeatpwd) !== false) {
    header("location: ../signup.php?error=pwderror");
    exit();
  }
  if (emailExists($conn, $email) !== false) {
    header("location: ../signup.php?error=emailtaken");
    exit();
  }

  createUser($conn, $userType, $firstName, $lastName, $email, $pwd);


} else {
  header("location: ../signup.php");
  exit();
}
