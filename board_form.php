
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

mysql_select_db($database_book, $book);
$query_rb = "SELECT * FROM tbl_board WHERE a_ans !='' order by b_id desc";
$rb = mysql_query($query_rb, $book) or die(mysql_error());
$row_rb = mysql_fetch_assoc($rb);
$totalRows_rb = mysql_num_rows($rb);

$colname_mm = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_mm = $_SESSION['MM_Username'];
}
mysql_select_db($database_book, $book);
$query_mm = sprintf("SELECT * FROM tbl_member WHERE mem_user = %s", GetSQLValueString($colname_mm, "text"));
$mm = mysql_query($query_mm, $book) or die(mysql_error());
$row_mm = mysql_fetch_assoc($mm);
$totalRows_mm = mysql_num_rows($mm);
$mem_user=$_POST['MM_Username'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ระบบจองหนังสือ</title>
    <?php include('css.php');?>
     <?php include('datatable.php');?>
    
    
    
  </head>
  <body>
    <?php  include('menu.php');?>
   
         <div class="container">
  <div class="row">
      <div class="col-md-1"></div> 
      <div class="col-md-9">
            <h3 align="center"> ตั้งกระทู้ถามตอบ </h3>

            <form action="board_form_db.php" method="POST"  name="contact"  id="contact">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
         <tr>
            <td align="right"> หัวข้อ &nbsp;</td>
            <td colspan="2">
              <input name="b_title" type="text"  class="form-control" placeholder="กรุณากรอกข้อมูล" required></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td width="18%" align="right" valign="top">รายละเอียด&nbsp;</td>
            <td colspan="2"><textarea name="b_detail" rows="3" required class="form-control" id="detail" placeholder="กรุณากรอกข้อมูล"></textarea></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="center">&nbsp;</td>
            <td colspan="3" align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center">&nbsp;</td>
            <td colspan="3" align="left">
        
              <input type="submit" name="save" class="btn btn-primary" value="บันทึก" >
              <input type="hidden" name="mem_id" value="<?php echo $row_mm['mem_id']; ?>">
            </td>
          </tr>
          <tr>
            <td colspan="4" align="center"></td>
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
mysql_free_result($rb);


?>
