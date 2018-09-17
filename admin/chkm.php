<?php require_once('../Connections/book.php'); ?>
<?php
error_reporting( error_reporting() & ~E_NOTICE );
if (!isset($_SESSION)) {
  session_start();
}

