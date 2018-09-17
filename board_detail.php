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
$b_id = $_GET['b_id'];
mysql_select_db($database_book, $book);
$query_rb = "SELECT * FROM tbl_board WHERE b_id=$b_id";
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
    <title>ระบบจองหนังสือ</title>
    <?php include('css.php');?>
     <?php include('datatable.php');?>
    
    
    
  </head>
  <body>
    <?php  include('menu.php');?>
   
        <div class="container">
  <div class="row">
      
      <div class="col-md-12">
            <h3 align="center"> รายละเอียดกระทู้ </h3>
      </div> 
    </div> 
    <div class="row">
      <div class="col-md-2"></div> 
      <div class="col-md-8"  style="background-color:#f1f1f1">

            <h4> คำถาม : <?php echo $row_rb['b_title'];?> </h4>
            <b> รายละเอียด :  </b> <?php echo $row_rb['b_detail'];?> <br />
            <b> โดย : </b> <?php echo $row_rb['mem_name'];?>
            ว/ด/ป : <?php echo date('d/m/Y',strtotime($row_rb['date_save']));?>
            <hr/>

          </div> 
          <hr />
        </div> 
        <div class="row">
      <div class="col-md-2"></div> 
      <div class="col-md-8" style="background-color:#f8f8f8">

            
            <h4> คำตอบ : <br />
             &nbsp;   &nbsp;   &nbsp;  
              <?php echo $row_rb['a_ans'];?> </h4><br />
            ว/ด/ป : <?php echo date('d/m/Y',strtotime($row_rb['a_ans_date']));?>
                
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