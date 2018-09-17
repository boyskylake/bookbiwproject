<?php require_once('Connections/book.php'); ?>
<?php include('ckm.php');?>
<?php
session_start();
//print_r($_SESSION);
//echo $_SESSION['MM_Username'];
//echo "<hr>";
if($_SESSION['MM_Username'] !=''){
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

$colname_pf = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_pf = $_SESSION['MM_Username'];
}
mysql_select_db($database_book);
$query_pf = sprintf("SELECT * FROM tbl_member WHERE mem_user = %s", GetSQLValueString($colname_pf, "text"));
$pf = mysql_query($query_pf) or die(mysql_error());
$row_pf = mysql_fetch_assoc($pf);
$totalRows_pf = mysql_num_rows($pf);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php include('css.php');?>
    <?php include('datatable.php');?>
    <style type="text/css">
	@media print{
	#hp{
		display:none;
	}
}
	body,td,th {
	font-family: Lato, "Helvetica Neue", Helvetica, Arial, sans-serif;
}
body {
	background-image: url(img/huayi.jpg_640x640.jpg);
}
    </style>
  </head>
  <body>
  <div class="container">
  <div class="row">
  <span id="hp">
   <h1 align="center">Book Ddelivery</h1>

  </span>
 <!--start show  product-->
 <div class="container">
 	<div class="row">
    	<!-- menu-->
    	<div class="col-md-3" id="hp">
        	  <?php include('m_menu.php');?>
        </div>
        <!-- content-->
      
        <div class="col-md-9">
        	<?php 
			$page = $_GET['page'];
			if($page=='mycart'){
			include('mycart.php');	
			}else{
			include('detail_order_afer_cartdone.php');
			}
			
			?>
		
			
         
        </div>
    </div>
</div>
 <!--end show  product-->
 
 
 
 
 
  </body>
</html>
<?php
mysql_free_result($pf);
 } else{ include('logout.php'); }//seseion
?>
<?php  include('footer.php');?>