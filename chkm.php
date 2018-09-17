<?php require_once('Connections/book.php'); ?>
<?php
error_reporting( error_reporting() & ~E_NOTICE );
if (!isset($_SESSION)) {
  session_start();
}
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_member = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_member = $_SESSION['MM_Username'];
}
mysql_select_db($database_book);
$query_member = sprintf("SELECT * FROM tbl_member WHERE mem_user = %s", GetSQLValueString($colname_member, "text"));
$member = mysql_query($query_member) or die(mysql_error());
$row_member = mysql_fetch_assoc($member);
$totalRows_member = mysql_num_rows($member); 


$ms_id = $row_member['ms_id'];

// echo 'ms id = '.$ms_id;



// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';


// echo '<hr>';
// echo '<pre>';
// print_r($row_member);
// echo '</pre>';
//exit;
?>

<?php

      //$ms_id = $row_mm['ms_id'];
      if($ms_id==3){

      	// echo 'tea';
      echo "<script type='text/javascript'>";
      echo "window.location='index.php';";
      echo "</script>";
      }elseif($ms_id==2) {
      	//echo 'mm';
      	 echo "<script type='text/javascript'>";
      echo "window.location='staff/index.php';";
      echo "</script>";
  	  }elseif($ms_id==1){

  	  	//echo 'admin';
  	  	echo "<script type='text/javascript'>";
  	  echo "window.location='admin/index.php';";
  	  echo "</script>";
  	  }else {
  	  	echo "<script type='text/javascript'>";
  	  echo "window.location='login.php';";
  	  echo "</script>";
  	  }
      

?>
