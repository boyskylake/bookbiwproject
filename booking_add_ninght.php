
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

$colname_show = "-1";
if (isset($_GET['bi_id'])) {
  $colname_show = $_GET['bi_id'];
}
mysql_select_db($database_book);
$query_show = sprintf("SELECT * FROM 
tbl_booking as o, 
tbl_booking_detail as d, 
tbl_book as p,
tbl_member  as m
WHERE o.bi_id = %s 
AND o.bi_id=d.bi_id 
AND d.bo_id=p.bo_id
AND o.mem_id = m.mem_id 
ORDER BY o.bi_id ASC
", GetSQLValueString($colname_show, "int"));
$show = mysql_query($query_show) or die(mysql_error());
$row_show = mysql_fetch_assoc($show);
$totalRows_show = mysql_num_rows($show);

$bi_return=$row_show['bi_return'];
$bi_in=$row_show['bi_in'];
$bi_fine=$row_show['bi_fine'];

mysql_select_db($database_book, $book);
$query_bu = "SELECT * FROM tbl_building";
$bu = mysql_query($query_bu, $book) or die(mysql_error());
$row_bu = mysql_fetch_assoc($bu);
$totalRows_bu = mysql_num_rows($bu);



?>
<script>		
$(document).ready(function() {
    $('#example').DataTable( {
      "aaSorting" :[[0,'desc']],
	  //"lengthMenu":[[20,50, 100, -1], [20,50, 100,"All"]]
	});
} );
 
	</script>
  <script>
function myFunction() {
    var checkBox = document.getElementById("myCheck");
    var checkBox2 = document.getElementById("myCheck1");

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

}
</script>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>


<h4> รายละเอียดการจอง
</h4>
 <form  name="formlogin" action="book_ninght_db.php" method="POST" id="login" class="form-horizontal">
<table border="2" class="display1 table table-bordered" id="example1" align="center" >
  <thead>
    <tr class="success">    
   <th width="5%"><center>ID</center></th>
      <th width="50%"><center>หนังสือ</center></th>
      <th width="10%"><center>จำนวน</center></th>
    
 
  </tr>
</thead>
  <?php if($totalRows_show > 0){ do{?>
  
    <tr>
     <td ><?php echo $row_show['bo_id']; ?></td>
    <td ><?php echo $row_show['bo_name']; ?></td>
    <td ><?php echo $row_show['bd_qty']; ?></td>

     <input  type="hidden" name="bo_id[]" value="<?php echo $row_show['bo_id']; ?>">
          <input  type="hidden" name="bd_qty[]" value="<?php  echo  $row_show['bd_qty']; ?>">

          <input  type="hidden" name="mm[]" value="<?php  echo  $row_show['bo_id']; ?>-<?php  echo  $row_show['bd_qty']; ?>">  
   
 <?php 
      //$osum = 0;
      @$osum += $row_show['bd_qty'];

        $bi_return = date('Y-m-d',strtotime($bi_return));
        $bi_in = date('Y-m-d',strtotime($bi_in));
        $calculate =strtotime($bi_in)-strtotime($bi_return);
        $bi_fine = floor($calculate / 86400);
        


      ?>
    </tr>

<?php } while ($row_show =  mysql_fetch_assoc($show));}?>

<tr>
    <td colspan="4">
      <p align="right">
        <b>
        <font color="red"> รวม = <?php echo $osum; ?>  เล่ม </font>
        </b>
      </p>
    </td>
  </tr>
  
    </table>

  
    
   <div class="container">
  <div class="row">
    <div class="col-md-5">
      กำหนดคืน : <?php echo date('d-m-Y',strtotime($bi_return));?><br>
      วันที่คืน : <?php echo date ('d-m-Y');?><br>
      <?php 
      $today =  date ('d-m-Y');
      $today2 =  date ('Y-m-d');
      $calculate =strtotime($today)-strtotime($bi_return);
       $daymore = floor($calculate / 86400);
       $total = $daymore * 15;
     ?>
     จำนวนวันที่เกิน : <?php if  ($daymore <= 0){
          echo 0;
        }elseif( $daymore > 0){
         echo $daymore;


        } 
        ?> วัน<br>

     ค่าปรับ = <?php 
if  ($daymore <= 0){
          $total = 0;
          echo $total;
        }elseif( $daymore > 0){
         echo $total;


        } 
        ?> บาท
      <h4> ทำการคืน</h4>
         </div> 
         

         <div class="form-group">
          <div class="col-md-12">
         <input type="radio" name="bn_room" id="myCheck2" value="1"  onclick="myFunction()">
         คืนที่ห้องสมุดสำนักวิทยบริการและเทคโนโลยีสารสนเทศ
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">

        <input type="radio" name="bn_room" id="myCheck" value="2" onclick="myFunction()"> คืนที่ทำงาน 
<p id="text" style="display:none">
          <select name="bn_id" >
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

  <select name="bn_class" id="bn_class" >
    <option>ชั้น</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
  </select>

<input type="text" name="bn_no"   placeholder="หมายเลขห้อง">
</p>
          </div>
        </div>
       <?php 
    if($total > 1){ ?> 
      <div class="form-group">
          <div class="col-md-2">
            <select name="s_at" id="s_at" class="form-control">
              <option>--เลือกจ่ายค่าปรับ--</option>
              <option>ห้องสมุด</option>
              <option>พนักงาน</option>
            </select>
          </div>
        </div>

 <div class="form-group">
          <div class="col-md-12">
      
        <button type="submit" class="btn btn-success" name="btnadd"> ยืนยัน </button>
            <input type="hidden" name="bi_id" id="bi_id" value="<?php echo $_GET['bi_id']; ?>"
             />
             <input type="hidden" name="bi_in" id="bi_in" value="<?php echo $today2?>"/>
             <input type="hidden" name="bi_fine" id="bi_fine" value="<?php echo $total ?>"/>
          </div>
        </div>
  
  <?php } elseif($total < 1){ ?>
   <div class="form-group">
          <div class="col-md-12">
      
        <button type="submit" class="btn btn-success" name="btnadd"> ยืนยัน </button>
            <input type="hidden" name="bi_id" id="bi_id" value="<?php echo $_GET['bi_id']; ?>"
             />
             <input type="hidden" name="bi_in" id="bi_in" value="<?php echo $today2?>"/>
             <input type="hidden" name="bi_fine" id="bi_fine" value="<?php echo $total ?>"/>
          </div>
        </div>
        <?php } ?>
  </form>
</div>
</div>

   
     
     <?php 

mysql_free_result($member);
mysql_free_result($bu);

mysql_free_result($show);
?>
	