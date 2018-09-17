<?php  require_once('Connections/book.php'); ?>
<?php include('ckm.php');?>
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

$colname_editm = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_editm = $_SESSION['MM_Username'];
}
mysql_select_db($database_book);
$query_editm = sprintf("SELECT * 
FROM tbl_member 
WHERE mem_user = %s
", GetSQLValueString($colname_editm, "text"));
$editm = mysql_query($query_editm) or die(mysql_error());
$row_editm = mysql_fetch_assoc($editm);
$totalRows_editm = mysql_num_rows($editm);
// echo '<pre>';
// print_r($row_editm);
// echo '</pre>';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
<div class="container">
  <div class="row">
    <div class="col-md-12">
<h1 align="center">Book Ddelivery</h1>
</div>
</div>
</div>
<div class="container">
  <div class="row">
      <!-- menu-->
      <div class="col-md-3">
            <?php include('m_menu.php');?>
        </div>
        <div class="col-md-9">
        <h3 align="center">  แก้ไขข้อมูลส่วนตัว  <?php include('edit-ok.php');?> </h3>
			<form  name="register" action="edit_member_db.php" method="POST" id="register" class="form-horizontal" enctype="multipart/form-data">
       <div class="form-group">
       <div class="col-sm-3">  </div>
       <div class="col-sm-5" align="left">
       <font color="red"> *กรุณากรอกข้อมูลให้ครบทุกช่อง </font>
       </div>
       </div>
       <div class="form-group">
       	<div class="col-sm-3" align="right"> Username : </div>
          <div class="col-sm-5" align="left">
            <input  name="mem_user" type="text"  class="form-control" id="mem_user" value="<?php echo $row_editm['mem_user']; ?>" minlength="2"  />
          </div>
      </div>
        
        <div class="form-group">
        <div class="col-sm-3" align="right"> Password : </div>
          <div class="col-sm-5" align="left">
            <input  name="mem_pass" type="password" required class="form-control" id="mem_pass" placeholder="password" pattern="^[a-zA-Z0-9]+$" value="<?php echo $row_editm['mem_pass']; ?>" minlength="2" />
          </div>
        </div>

        
        <div class="form-group">
  <div class="col-sm-3" align="right">ชื่อ</div>
       <div class="col-sm-5" align="left">
        <input type="text" name="mem_name" id="mem_name" class="form-control" value="<?php echo $row_editm['mem_name']; ?>">
         </div>
       </div>

               <div class="form-group">
  <div class="col-sm-3" align="right">ที่อยู่</div>
       <div class="col-sm-5" align="left">
        <textarea name="mem_address" id="mem_address" class="form-control"><?php echo $row_editm['mem_address']; ?></textarea>
         </div>
       </div>

     

    
  
        <div class="form-group">
        <div class="col-sm-3" align="right"> อีเมล์ : </div>
          <div class="col-sm-5" align="left">
            <input  name="mem_email" type="email" class="form-control" id="mem_email"   placeholder="อีเมล์" value="<?php echo $row_editm['mem_email']; ?>"/>
          </div>
        </div>
        <div class="form-group">
        <div class="col-sm-3" align="right"> เบอร์โทร : </div>
          <div class="col-sm-5" align="left">
            <input  name="mem_tel" type="text" class="form-control" id="mem_tel"  placeholder="เบอร์โทร" value="<?php echo $row_editm['mem_tel']; ?>" />
          </div>
        </div>

      <div class="form-group">
      <div class="col-sm-3"> </div>
          <div class="col-sm-6">
          <button type="submit" class="btn btn-primary" id="btn">  บันทึก   </button>
          <input name="mem_id" type="hidden" id="mem_id" value="<?php echo $row_editm['mem_id']; ?>">
          <input name="do" type="hidden" id="do" value="edit-profile">
          </div>
           
      </div>
      </form>   
      </div>
      </div>  
      </div>   
                    
 

<?php
mysql_free_result($editm);
?>
