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
<form action="book_add_form_db.php" method="POST" enctype="multipart/form-data"  name="add" class="form-horizontal" id="add">
  <h4>เพิ่มข้อมูลหนังสือ</h4>
  <div class="form-group">
  <div class="col-sm-3" align="right">ประเภท</div>
    <div class="col-sm-5" align="left">
      <select name="bt_id" id="bt_id" class="form-control">
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
  <div class="col-sm-3" align="right">ชื่อหนังสือ</div>
       <div class="col-sm-5" align="left">
        <input type="text" name="bo_name" id="bo_name" class="form-control" required="required">
         </div>
       </div>
       
<div class="form-group">
    <div class="col-sm-3" align="right"> รายละเอียด </div>
    <div class="col-sm-5" align="left">
     <textarea name="bo_detail" id="bo_detail" class="form-control" required="required"></textarea>
    </div>
    </div>

  <div class="form-group">
    <div class="col-sm-3" align="right"> จำนวน </div>
    <div class="col-sm-5" align="left">
     <input type="number" name="bo_qty" id="bo_qty" class="form-control">
    </div>
    </div>
            <div class="form-group">
                          <div class="col-md-3"></div>
                          <div class="col-md-7">
                           preview <br>
 
                           <img  id="bo_img" alt="" width="100" height="100">
                          </div>
                      </div>
        <div class="form-group">
                          <label class="control-label col-md-3"  >รูปภาพ :</label>
                          <div class="col-md-5">
                              <input type="file" class="form-control" id="bo_img" name="bo_img" accept="image/png, image/jpeg, image/gif " onchange="preview_image(event) ">
                          </div>
                      </div>   

           
<div class="form-group">
    <div class="col-sm-3"> </div>
    <div class="col-sm-6">
      <button type="submit" class="btn btn-primary" id="btn"> เพิ่มข้อมูล </button>
    </div>
  </div>
</form>
<?php


mysql_free_result($type);
?>
