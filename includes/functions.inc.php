<?php


function emptyInputSignup($firstName, $lastName, $email, $pwd, $repeatpwd, $userType) {
  $result;
  if (empty($firstName) || empty($lastName) || empty($email) || empty($pwd) || empty($repeatpwd) || empty($userType)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function invalidEmail($email) {
  $result;
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function pwdMatch($pwd, $repeatpwd) {
  $result;
  if ($pwd !== $repeatpwd) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function emailExists($conn, $email) {
  $sql = "SELECT * FROM users WHERE usersEmail = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  } else {
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);
}

function createUser($conn, $userType, $firstName, $lastName, $email, $pwd) {
  $sql = "INSERT INTO users (usersType, usersFName, usersLName, usersEmail, usersPwd) VALUES (?, ?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmtfailed");
    exit();
  }

  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($stmt, "sssss", $userType, $firstName, $lastName, $email, $hashedPwd);
  mysqli_stmt_execute($stmt);

  mysqli_stmt_close($stmt);
  header("location: ../signup.php?error=none");
  exit();
}

function emptyInputLogin($email, $pwd) {
  $result;
  if (empty($email) || empty($pwd)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function emptyInputLink($email) {
  $result;
  if (empty($email)) {
    $result = true;
  } else {
    $result = false;
  }
  return $result;
}

function loginUser($conn, $email, $pwd) {
  $emailExists = emailExists($conn, $email);

  if ($emailExists === false) {
    header("location: ../login.php?error=wronglogin");
    exit();
  }

  $pwdHashed = $emailExists["usersPwd"];
  $checkPwd = password_verify($pwd, $pwdHashed);

  if ($checkPwd === false) {
    header("location: ../login.php?error=wronglogin");
    exit();
  } else if ($checkPwd === true) {
    session_start();
    $_SESSION["userid"] = $emailExists["usersId"];
    $_SESSION["useremail"] = $emailExists["usersEmail"];
    $_SESSION["usertype"] = $emailExists["usersType"];
    $_SESSION['linkCode'] = $emailExists["linkCode"];
    if($_SESSION['linkCode'] !== NULL) {
      $_SESSION['linked'] = 'active';
    } else {
      $_SESSION['linked'] = 'inactive';
    }
    header("location: ../index.php");
    exit();
  }
}

function getInfo($conn, $email) {
  $emailExists = emailExists($conn, $email);

  if ($emailExists === false) {
    header("location: ../link.php?error=noemail");
    exit();
  } else {
    if($emailExists["usersType"] == 'userbbs') {
      session_start();
      $_SESSION['bbsfname'] = $emailExists["usersFName"];
      $_SESSION['bbslname'] = $emailExists["usersLName"];
      $_SESSION['bbsemail'] = $emailExists["usersEmail"];
      header("location: ../link.php?info=confirm");
      exit();
    } else {
      header("location: ../link.php?error=notbbs");
      exit();
    }
  }
}

function linkTogether($conn) {
  session_start();
  $linkCode = $_SESSION["userid"];
  $bbsEmail = $_SESSION['bbsemail'];
  $sql = "UPDATE users SET linkCode=$linkCode WHERE usersEmail='".$bbsEmail."'";

  if (mysqli_query($conn, $sql)) {
    $sql = "UPDATE users SET linkCode=$linkCode WHERE usersId=$linkCode";
    if (mysqli_query($conn, $sql)) {
      header("location: ../link.php?error=none");
      createSharedPage($conn);
      exit();
    } else {
      header("location: ../link.php?error=linkfail");
      exit();
    }
  } else {
    header("location: ../link.php?error=linkfail");
    exit();
  }
}

function createSharedPage($conn) {
  $code = $_SESSION["userid"];

  if($_SESSION['linkCode'] === NULL) {
    $_SESSION['linked'] = 'inactive';
  }

  $sql = "INSERT INTO info (linkCode) VALUES (?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    $_SESSION['linked'] = 'inactive';
    header("location: ../link.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "s", $code);
  mysqli_stmt_execute($stmt);

  mysqli_stmt_close($stmt);
  $_SESSION['linked'] = 'active';
  header("location: ../link.php?error=none");
  exit();
}

// function addList($conn, $list, $num) {
//   $code = $_SESSION["userid"];
//
//   for ($x = 0; $x < $list.length; $x++) {
//     $a = $x . 1;
//     $sql = "INSERT INTO info ($list['task'.$a]) VALUES (?);";
//     $stmt = mysqli_stmt_init($conn);
//     if (!mysqli_stmt_prepare($stmt, $sql)) {
//       $_SESSION['linked'] = 'inactive';
//       header("location: ../reports.php?error=stmtfailed");
//       exit();
//     }
//
//     mysqli_stmt_bind_param($stmt, "s", $code);
//     mysqli_stmt_execute($stmt);
//
//     mysqli_stmt_close($stmt);
//   }
//
//   $_SESSION['linked'] = 'active';
//   header("location: ../reports.php?error=none");
//   exit();
// }
