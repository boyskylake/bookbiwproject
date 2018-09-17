<?php require_once('Connections/book.php'); ?>
<?php
error_reporting( error_reporting() & ~E_NOTICE );
if (!isset($_SESSION)) {
  session_start();
}
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

$colname_member = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_member = $_SESSION['MM_Username'];
}
mysql_select_db($database_book);
$query_member = sprintf("SELECT * FROM tbl_member WHERE mem_user = %s", GetSQLValueString($colname_member, "text"));
$member = mysql_query($query_member) or die(mysql_error());
$row_member = mysql_fetch_assoc($member);
$totalRows_member = mysql_num_rows($member); 
?>
<!--start menu -->
    <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">ระบบจองหนังสือ</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="index.php">หน้าหลัก<span class="sr-only">(current)</span></a></li>
        <li><a href="board.php">กระทู้<span class="sr-only">(current)</span></a></li>
        
     <!--  	<li><a href="Cart.php">ตะกร้าสินค้า<span class="sr-only">(current)</span></a></li> -->
  
      </ul>
      <form class="navbar-form navbar-left"  method="get" name="B" action="index.php">
        <div class="form-group">
          <select type="text" class="form-control" name="type_book">
                  <option value="bo_name">ชื่อหนังสือ</option>
                  <option value="isbn">ISBN</option>
          </select>
        </div>
        <div class="form-group">
          <input type="text" class="form-control" name="bo_name" placeholder="กรุณากรอกชื่อหนังสือ">
        </div>
        <button type="submit" name="button" value="button" class="btn btn-default">ค้นหา</button>
      
      
      </form>
      <ul class="nav navbar-nav navbar-right">
       <li><a href="#"data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">ช่องทางการติดต่อสอบถาม</a></li> 
        <?php 
      $mm = ($_SESSION['MM_Username']);
      
      if($mm !=''){
        echo "<li>";
        echo "<a href='profile.php'>"."<span class='glyphicon glyphicon-user'></span>"."โปรไฟล์";
        echo  " คุณ" .$row_member['mem_name'];
        echo "</a>";
        echo "</li>";
        
        echo "<li><a href='logout.php'>ออกจากระบบ</a></li>";
        
      }else{
        echo "<li><a href='login.php'>Login</a></li>";
        
      }

?>
      </ul>
    </div>
  </div>
</nav>
<!--end menu-->

<!--Start Modal-->
<!-- Buttom Modal
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"></button>
-->


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">ช่องทางการติดต่อสอบถาม</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Facebook:test</label>
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Line:test</label>
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Phone:test</label>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php
mysql_free_result($member);
?>
