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

mysql_select_db($database_book, $book);
$query_Recordset1 = "SELECT * FROM tbl_building";
$Recordset1 = mysql_query($query_Recordset1, $book) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_book, $book);
$query_Recordset2 = "SELECT * FROM tbl_faculty";
$Recordset2 = mysql_query($query_Recordset2, $book) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

    error_reporting( error_reporting() & ~E_NOTICE );
    session_start(); 
    $bo_id = $_REQUEST['bo_id']; 
	$act = $_REQUEST['act'];

	if($act=='add' && !empty($bo_id))
	{
		if(!isset($_SESSION['shopping_cart']))
		{
			 
			$_SESSION['shopping_cart']=array();
		}else{
		 
		}
		if(isset($_SESSION['shopping_cart'][$bo_id]))
		{
			$_SESSION['shopping_cart'][$bo_id]++;
		}
		else
		{
			$_SESSION['shopping_cart'][$bo_id]=1;
		}
	}

	if($act=='remove' && !empty($bo_id))  //ยกเลิกการสั่งซื้อ
	{
		unset($_SESSION['shopping_cart'][$bo_id]);
	}

	if($act=='update')
	{
		$amount_array = $_POST['amount'];
		foreach($amount_array as $bo_id=>$amount)
		{
			$_SESSION['shopping_cart'][$bo_id]=$amount;
		}
	}
	if($act=='Cancel-Cart'){
		unset($_SESSION['shopping_cart']);	
	}
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
	background-image: url(img/155791c6f9ec63b.jpg);
}
    </style>
    <?php include('css.php');?>
    
  </head>
  <body>
<?php include("menu.php");?>
<br>
<br>
<div class="container">
  <div class="row">
   <div class="col-md-2">
  <?php include('listgroup.php');?>
</div>
    <div class="col-md-10">
      <form id="frmcart" name="frmcart" method="post" action="?act=update">
      	<p align="center"> 
      <a href="index.php" class="btn btn-success">
      <span class="glyphicon glyphicon-home" aria-hidden="true"></span>กลับไปเลือกหนังสือ</a>
      </p>
        <table width="100%" border="0" align="center" class="table table-hover">
        <tr>
          <td height="40" colspan="5" align="center" bgcolor="#CCCCCC"><strong>รายการจอง</strong></td>
        </tr>
        <tr>
          <td align="center" bgcolor="#EAEAEA"><strong>No.</strong></td>
          <td align="center" bgcolor="#EAEAEA"><strong>รูปภาพ</strong></td>
          <td align="center" bgcolor="#EAEAEA"><strong>ชื่อหนังสือ</strong></td>
          <td align="center" bgcolor="#EAEAEA"><strong>จำนวน</strong></td>
          <td align="center" bgcolor="#EAEAEA"><strong>ลบ</strong></td>
        </tr>
        <?php

if(!empty($_SESSION['shopping_cart']))
{
require_once('Connections/book.php');
	foreach($_SESSION['shopping_cart'] as $bo_id=>$bo_qty)
	{
		$sql = "select * from tbl_book where bo_id=$bo_id";
		$query = mysql_db_query($database_book, $sql);
		while($row = mysql_fetch_array($query))
		{
		 
		$sum = $bo_qty;
		$total += $sum;
		echo "<tr>";
		echo "<td align='center' width='10'>";
        echo $i += 1; //+1ไปเรื่อยย
        echo ".";
		echo "</td>";
		echo "<td width='100' align='center'>"."<img src='img/$row[bo_img]'  width='80'/>"."</td>";
		echo "<td width='334' align='center'>"." " . $row["bo_name"] . "</td>";	
		echo "<td width='57' align='center'>";  
		echo "<input type='text' name='amount[$bo_id]' value='$bo_qty' size='2'/></td>";
		
		// echo "<td width='100' align='center'>" .number_format($sum,2)."</td>";
		echo "<td width='100' align='center'><a href='cart.php?bo_id=$bo_id&act=remove' class='btn btn-danger btn-xs'>x</a></td>";
		
		echo "</tr>";
		}
 
	}
	  echo "<tr>";
  	echo "<td colspan='3' bgcolor='#CEE7FF' align='right'>รวมจำนวนเล่ม</td>";
  	echo "<td align='right' bgcolor='#CEE7FF'>";
  	echo "<b>";
   
  } 
  	if($total <=3){ ?>
    <?php echo $total;?>เล่ม</b></td>
    <td align='left' bgcolor='#CEE7FF'></td>
    </tr>
    <tr>
    <td>
    </td>
    <td colspan='5' align='right'>
    <a href='cart.php?act=Cancel-Cart' class='btn btn-danger'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span> ยกเลิกการจอง</a>

   

    <button type='button' name='Submit2'  onclick="window.location='confirm_order.php';" class='btn btn-info'><span class='glyphicon glyphicon-shopping-cart'> </span> ยืนยันการจอง </button>

    </td>
    </tr>
   
    <?php }elseif($total >3){ ?>
    <?php echo $total;?>เล่ม</b><br>
    </td>
    <td align='left' bgcolor='#CEE7FF'></td>
    </tr>
    <tr>
    <td colspan='4' bgcolor='#CEE7FF' align='right'>
    <font color='red'>!!คุณทำรายการจองเกิน3เล่มไม่สามารถทำการยืนยันการจองได้</font>
    </td>
    <td align='right' bgcolor='#CEE7FF'>
    </td>
    </tr>
    <tr>

    <td>
    </td>

    <td colspan='5' align='right'>
    <a href='cart.php?act=Cancel-Cart' class='btn btn-danger'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span> ยกเลิกตะกร้าสินค้า </a>

    <button type='submit' name='button' id='button' class='btn btn-warning'><span class='glyphicon glyphicon-repeat' aria-hidden='true'></span> คำนวณราคาใหม่ </button>

    </td>
    </tr>
  <?php } ?>
  
   </table>
      </form>
      
    </div>
  </div>
</div>
       
      
    </div>
  </div>
</div>
 
<div class="container">
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12">
                <?php include('footer.php');?>
              </div>
            </div>
          </div>

</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
