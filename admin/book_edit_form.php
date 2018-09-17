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

$colname_product = "-1";
if (isset($_GET['bo_id'])) {
  $colname_product = $_GET['bo_id'];
}
mysql_select_db($database_book);
$query_product = sprintf("SELECT
* FROM tbl_book as p , tbl_book_type as t
WHERE p.bt_id = t.bt_id
AND p.bo_id = %s", GetSQLValueString($colname_product, "int"));
$product = mysql_query($query_product) or die(mysql_error());
$row_product = mysql_fetch_assoc($product);
$totalRows_product = mysql_num_rows($product);

mysql_select_db($database_book);
$query_type = "SELECT * FROM tbl_book_type";
$type = mysql_query($query_type) or die(mysql_error());
$row_type = mysql_fetch_assoc($type);
$totalRows_type = mysql_num_rows($type);

?>
<script type='text/javascript'>
        function preview_image(event) 
        {
             var reader = new FileReader();
             reader.onload = function()
             {
                  var output = document.getElementById('bo_img');
                  output.src = reader.result;
             }
             reader.readAsDataURL(event.target.files[0]);
        }
        </script>
<form action="book_form_edit_db.php" method="POST" enctype="multipart/form-data"  name="add" class="form-horizontal" id="add">
  <h4>แก้ไขข้อมูลสินค้า</h4>
  <div class="form-group">
  <div class="col-sm-3" align="right">ประเภท</div>
    <div class="col-sm-5" align="left">
      <select name="bt_id" id="bt_id" class="form-control">
        <option value="<?php echo $row_product['bt_id']?>"><?php echo $row_product['bt_name']?></option>
        <option value="00">--เลือกประเภท--</option>
        <?php
do {  
?>
        <option value="<?php echo $row_type['bt_id']?>"><?php echo $row_type['bt_name']?></option>
        <?php
} while ($row_type = mysql_fetch_assoc($type));
  $rows = mysql_num_rows($type);
  if($rows > 0) {
      mysql_data_seek($type, 0);
	  $row_type = mysql_fetch_assoc($type);
  }
?>
      </select>
    </div>
    </div>
     <div class="form-group">
  <div class="col-sm-3" align="right">ISBN</div>
       <div class="col-sm-5" align="left">
        <input type="text" name="isbn" id="isbn" class="form-control" value="<?php echo $row_product['isbn']?>">
         </div>
       </div>
    <div class="form-group">
  <div class="col-sm-3" align="right">ชื่อหนังสือ</div>
       <div class="col-sm-5" align="left">
        <input type="text" name="bo_name" id="bo_name" class="form-control" value="<?php echo $row_product['bo_name']?>">
         </div>
       </div>
       
<div class="form-group">
    <div class="col-sm-3" align="right"> รายละเอียดสินค้า </div>
    <div class="col-sm-5" align="left">
     <textarea name="bo_detail" id="bo_detail" class="form-control"><?php echo $row_product['bo_detail']?></textarea>
    </div>
    </div>

  <div class="form-group">
    <div class="col-sm-3" align="right"> จำนวน </div>
    <div class="col-sm-5" align="left">
     <input type="text" name="bo_qty" id="bo_qty" class="form-control" value="<?php echo $row_product['bo_qty']?>">
    </div>
    </div> 
            <div class="form-group">
                          <div class="col-md-3"></div>
                          <div class="col-md-7">
                          
                          <img src="../img/<?php echo $row_product['bo_img']; ?>" width="100"><br><br>
                          เลือกใหม่ <br>
                           <img  id="bo_img" alt="" width="100" height="100" >
                            preview <br>
                          </div>
                      </div>
        <div class="form-group">
                          <label class="control-label col-md-3"  >รูปภาพ :</label>
                          <div class="col-md-5">
                              <input type="file" class="form-control" id="bo_img" name="bo_img" accept="image/png, image/jpeg, image/gif " onchange="preview_image(event)" >
                          </div>
                      </div>   

           
<div class="form-group">
    <div class="col-sm-3"> </div>
    <div class="col-sm-6">
      <button type="submit" class="btn btn-primary" id="btn"> ยืนยัน </button>
      <input type="hidden" name="bo_id" value="<?php echo $row_product['bo_id']?>">
      <input type="hidden" name="img" value="<?php echo $row_product['bo_img']?>">
    </div>
  </div>
</form>
<?php


mysql_free_result($type);

mysql_free_result($product);
?>
        