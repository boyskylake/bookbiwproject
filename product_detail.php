<?php include('ckm.php');?>
<?php require_once('Connections/book.php'); ?>
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

$colname_ShowProduct = "-1";
if (isset($_GET['bo_id'])) {
  $colname_ShowProduct = $_GET['bo_id'];
}
mysql_select_db($database_book);
$query_ShowProduct = sprintf("SELECT * FROM tbl_book WHERE bo_id = %s", GetSQLValueString($colname_ShowProduct, "int"));
$ShowProduct = mysql_query($query_ShowProduct) or die(mysql_error());
$row_ShowProduct = mysql_fetch_assoc($ShowProduct);
$totalRows_ShowProduct = mysql_num_rows($ShowProduct);

//update product view
$bo_id = $row_ShowProduct['bo_id'];
 $bo_view = $row_ShowProduct['bo_view'];
$count = $bo_view + 1;

 $sql= "UPDATE tbl_book SET  bo_view=$count WHERE bo_id = $bo_id";
	mysql_db_query($database_book,$sql);
//

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ระบบจองหนังสือ</title>
    <style type="text/css">
    body,td,th {
	font-family: Lato, "Helvetica Neue", Helvetica, Arial, sans-serif;
}
body {
	background-image: url(img/huayi.jpg_640x640.jpg);
}
    </style>
    <?php include('css.php');?>
    
  

  </head>
  <body>
<?php  include('menu.php');?>




<!-- start show product detail -->
<div class="container">
  <div class="row">
  <div class="col-md-2">
  <?php include('listgroup.php');?>
</div>
<div class="col-md-10">
  	<b> แสดงรายละเอียดหนังสือ </b>
    <div class="col-xs-12 col-sm-4 col-md-4">
      <!-- show product img -->
    <img src="img/<?php echo $row_ShowProduct['bo_img']; ?>" width="100%" class="img-thumbnail">
    </div>
    
    <div class="col-xs-12 col-sm-8 col-md-8">
      
        <!-- show product detail -->
      <p style="font-size:24px">
	  <?php echo $row_ShowProduct['bo_name']; ?> 
	 </p>
      
      <p style="font-size:24px">
      จำนวนหนังสือ:
      <b><font color="#FF0000">
	  <?php
	  $bo_qty = $row_ShowProduct['bo_qty'];
	  if($bo_qty<1){
	  echo "จองแล้ว";
	  ?>
      
	  <?php } else { ?>
	 
	 
	  <?php echo $row_ShowProduct['bo_qty'];?>
     
     
      <a href="index.php?bo_id=<?php echo $row_ShowProduct['bo_id'];?>&act=add" class="btn btn-info btn-sm">
      <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> จองหนังสือ</a>
      <?php }?></font></b></p>
        
    
   
      <b>รายละเอียด:</b><br>
	  
	  
	  <?php echo $row_ShowProduct['bo_detail']; ?> 
     <p>
      <span class="glyphicon glyphicon-eye-open"> </span>
     <span class="badge"> <?php echo $row_ShowProduct['bo_view']; ?>&nbsp; ครั้ง<br/>
      </p>
      
    </div>

    
  </div>
</div>
<!-- end show product detail -->


<!-- start footer-->
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <?php include('footer.php');?>
    </div>
  </div>
</div>
<!-- end footer-->


  
  </body>
</html>
<?php
mysql_free_result($ShowProduct);
?>
