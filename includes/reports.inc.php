<?php
$list = $_POST['fullList'];
$listItems = 0;
for ($x = 0; $x < $list.length; $x++) {
  $listItems++;
}

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

addList($conn, $list, $listItems);
