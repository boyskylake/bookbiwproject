<?php require_once('../Connections/book.php'); ?>
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

mysql_select_db($database_book, $book);
$query_rb = "SELECT * FROM tbl_board WHERE a_ans !='' order by b_id desc";
$rb = mysql_query($query_rb, $book) or die(mysql_error());
$row_rb = mysql_fetch_assoc($rb);
$totalRows_rb = mysql_num_rows($rb);
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
$b_id = $_GET['b_id'];

mysql_select_db($database_book, $book);
$query_rb = "SELECT 
* FROM tbl_board as b ,tbl_member as m
WHERE b.b_id=$b_id
AND b.mem_id=m.mem_id
ORDER BY b.b_id";
$rb = mysql_query($query_rb, $book) or die(mysql_error());
$row_rb = mysql_fetch_assoc($rb);
$totalRows_rb = mysql_num_rows($rb);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
<div class="container">
    
      <div class="col-md-8">
            <h3 align="center"> รายละเอียดกระทู้ </h3>
      </div> 
      <div class="row">
      <div class="col-md-2"></div> 
      <div class="col-md-8"  style="background-color:#f1f1f1">

            <h4> คำถาม : <?php echo $row_rb['b_title'];?> </h4>
            <b> รายละเอียด :  </b> <?php echo $row_rb['b_detail'];?> <br />
            <b> โดย : </b> <?php echo $row_rb['mem_name'];?><br>
            <b>วัน/เดือน/ปี :</b> <?php echo date('d/m/Y',strtotime($row_rb['datesave']));?>
            <hr/>

          </div> 
          <hr />

          <div class="col-md-2"></div> 
      <div class="col-md-8" style="background-color:#f8f8f8">

            
            <h4>ตอบคำถาม : </h4><br />
              <form action="board_db.php" method="POST"  name="contact"  id="contact">
        <table width="100%" border="0"  cellpadding="0" cellspacing="0">
          <tr>
            <td   valign="top"></td>
            <td colspan="2"><left>
              <textarea name="a_ans" rows="3" required="required" class="form-control" id="detail" placeholder="กรุณากรอกข้อมูล"><?php echo $row_rb['a_ans'];?></textarea></left></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td colspan="3">
              <br />
        
              <input type="submit" name="save" class="btn btn-primary" value="บันทึก" >
              <input type="hidden" name="b_id" value="<?php echo $row_rb['b_id'];?>">
            
            </td>
          </tr>
          <tr>
            <td colspan="4" ></td>
          </tr>
          <tr>
            <td align="right"><br /></td>
            <td>&nbsp;</td>
            <td width="10%">&nbsp;</td>
            <td width="41%">&nbsp;</td>
          </tr>
        </table>
      </form>
        </div>
      </div>
    </div>



  </body>
</html>
