<?php

require_once '../global.php';
if (isset($_POST["submit"])) {
   require_once 'dbh.inc.php';
   require_once 'functions.inc.php';

   linkTogether($conn);
   createSharedPage($conn);
} else {
   header("location: ../link.php");
   exit();
}
