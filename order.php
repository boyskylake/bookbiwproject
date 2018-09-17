<?php require_once('Connections/book.php'); ?>
<?php
//error_reporting( error_reporting() & ~E_NOTICE );
session_start(); 

// print_r($_POST);

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
$query_bu = "SELECT * FROM tbl_building";
$bu = mysql_query($query_bu, $book) or die(mysql_error());
$row_bu = mysql_fetch_assoc($bu);
$totalRows_bu = mysql_num_rows($bu);

mysql_select_db($database_book, $book);
$query_ft = "SELECT * FROM tbl_faculty";
$ft = mysql_query($query_ft, $book) or die(mysql_error());
$row_ft = mysql_fetch_assoc($ft);
$totalRows_ft = mysql_num_rows($ft);
//session_start();
$colname_buyer = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_buyer = $_SESSION['MM_Username'];
}
mysql_select_db($database_book);
$query_buyer = sprintf("SELECT * FROM tbl_member WHERE mem_user = %s", GetSQLValueString($colname_buyer, "text"));
$buyer = mysql_query($query_buyer) or die(mysql_error());
$row_buyer = mysql_fetch_assoc($buyer);
$totalRows_buyer = mysql_num_rows($buyer);




// print_r($_SESSION);

// session_destroy();
	//echo 'ss'.$row_buyer;
	
	if($_SESSION['MM_Username']!=''){  
?>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>

<script>
function myFunction() {
    var checkBox = document.getElementById("myCheck");
    var checkBox2 = document.getElementById("myCheck1");
    var checkBox3 = document.getElementById("myCheck2");
    var text = document.getElementById("text");
    if (checkBox.checked == true){
        text.style.display = "block";
    } else {
       text.style.display = "none";
    }

     if (checkBox2.checked == true){
        text2.style.display = "block";
    } else {
       text2.style.display = "none";
    }
    if (checkBox3.checked == true){
        text3.style.display = "block";
    } else {
       text3.style.display = "none";
    }
}
</script>

<p><a href="index.php">กลับไปเลือกหนังสือ</a> &nbsp;  <button class="btn btn-primary" onClick="window.print()"> print </button></p>
  <table width="600" border="1" align="center" class="table">
    <tr>
      <td width="1558" colspan="5" align="center">
      <strong>รายการจอง</strong></td>
    </tr>
    <tr class="success">
    <td align="center">ลำดับ</td>
      <td align="center">หนังสือ</td>
      <td align="center">รูปภาพ</td>
      <td align="center">จำนวน</td>
      <td align="center">รวม/รายการ</td>
    </tr>
  <form  name="formlogin" action="saveorder.php" method="POST" id="login" class="form-horizontal">
<?php
	require_once('Connections/book.php');
	$total=0;
	foreach($_SESSION['shopping_cart'] as $bo_id=>$bo_qty)
	{
		$sql = "select * from tbl_book where bo_id=$bo_id";
		$query = mysql_db_query($database_book, $sql);
		$row	= mysql_fetch_array($query);
		$sum	= $bo_qty;
		$total	+= $sum;
    echo "<tr>";
	echo "<td align='center'>";
	echo  $i += 1;
	echo "</td>";
    echo "<td width='334' align='center'>" . $row["bo_name"] . "</td>";
    echo "<td width='100' align='center'>"."<img src='img/$row[bo_img]'  width='80'/>"."</td>";
    echo "<td width='334' align='center'>$bo_qty</td>";
    echo "<td width='334' align='center'>".number_format($sum)."</td>";
    echo "</tr>";
?>

<input type="hidden"  name="bo_name" value="<?php echo $row['bo_name']; ?>" class="form-control" required placeholder="ชื่อ-สกุล" />



    <?php 
	}
	echo "<tr>";
    echo "<td  align='right' colspan='4'><b>รวม</b></td>";
    echo "<td align='right'>"."<b>".number_format($total)."</b>"."</td>";
    echo "</tr>";
?>
</table>

<div class="container">
  <div class="row">
  <div class="col-md-2"></div>
    <div class="col-md-5" style="background-color:#f4f4f4">
      <h3 align="center" style="color:green">
     
         แสดงข้อมูลผู้จอง</h3>  

        <div class="form-group">
          <div class="col-sm-12">
            <input type="text"  name="mem_name" value="<?php echo $row_buyer['mem_name']; ?>" class="form-control" required placeholder="ชื่อ-สกุล" />
          </div>
        </div>

        <div class="col-md-3"></div>
        <div class="col-md-6" style="color:green">
        <h4 align="center">ระบุที่จัดส่งหนังสือ</h4>
    </div>
         <div class="form-group">
          <div class="col-sm-12">
         <input type="radio" name="bi_room" id="myCheck2" value="1"  onclick="myFunction()">มารับที่ห้องสมุด สำนักวิทยบริการและเทคโนโลยีสารสนเทศ
          </div>
        </div>
        
        <div class="form-group">
          <div class="col-sm-12">

        <input type="radio" name="bi_room" id="myCheck" value="2" onclick="myFunction()">  ส่งที่ทำงาน 
<p id="text" style="display:none">
          <select name="bu_id" >
  <option value="00">อาคาร</option>
  <?php
do {  
?>
  <option value="<?php echo $row_bu['bu_id']?>"><?php echo $row_bu['bu_name']?></option>
  <?php
} while ($row_bu = mysql_fetch_assoc($bu));
  $rows = mysql_num_rows($bu);
  if($rows > 0) {
      mysql_data_seek($bu, 0);
	  $row_bu = mysql_fetch_assoc($bu);
  }
?>
</select>

  <select name="bi_class" id="bi_class" >
    <option>ชั้น</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
  </select>

<input type="text" name="bi_no"   placeholder="หมายเลขห้อง">
          </div>
        </div>
      
        <div class="form-group">
          <div class="col-sm-12">
             <input type="radio" name="bi_room" id="myCheck1" value="3" onclick="myFunction()">  ห้องสมุดคณะ 
<p id="text2" style="display:none">
<select name="ft_id"><
  <option value="00">คณะ</option>
  <?php
do {  
?>
  <option value="<?php echo $row_ft['ft_id']?>"><?php echo $row_ft['ft_name']?></option>
  <?php
} while ($row_ft = mysql_fetch_assoc($ft));
  $rows = mysql_num_rows($ft);
  if($rows > 0) {
      mysql_data_seek($ft, 0);
	  $row_ft = mysql_fetch_assoc($ft);
  }
?>
</select>
</div>
        </div>
        
        <div class="form-group">
          <div class="col-sm-12" align="center">
            
        
            <input name="mem_id" type="hidden" id="mem_id" value="<?php echo $row_buyer['mem_id']; ?>">
      
            <button type="submit" class="btn btn-primary" id="btn">
             ยืนยัน </button>
          </div>
        </div>
      </form>
   
<?php
 } else{  
  include('logout3.php'); 
 }//seseion
 
mysql_free_result($buyer);

mysql_free_result($bu);

mysql_free_result($ft);
?>
