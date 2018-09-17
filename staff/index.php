<?php include('hh.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <?php include('datatable.php'); ?>
          <style type="text/css">
          body,td,th {
	font-family: Lato, "Helvetica Neue", Helvetica, Arial, sans-serif;
}
body {
	background-image: url(../img/huayi.jpg_640x640.jpg);
}
          </style>
          <?php include('h.php');?>
  </head>
  <body>

    <div class="container">
      <div class="row">
        <div class="col-md-2">
          <?php include('menu_left.php');?>
        </div><br>
        <?php include('menu_top.php');?>
        <?php
        @$act=$_GET['act'];
        if($act=='ss'){
        echo "<div class='col-md-9'>";
          echo "<br />";
          include('ad_ss_booking.php');
        echo "</div>";
        }elseif($act=='ds'){
        echo "<div class='col-md-9'>";
          echo "<br />";
          include('ad_ds_booking.php');
        echo "</div>";
         }elseif($act=='bf'){
        echo "<div class='col-md-9'>";
          echo "<br />";
          include('booking_ninght_list.php');
        echo "</div>";
      }elseif($act=='de'){
        echo "<div class='col-md-9'>";
          echo "<br />";
          include('detail_booking.php');
        echo "</div>";
        }else{
        echo "<div class='col-md-9'>";
          echo "<br />";
          include('booking_list.php');
        echo "</div>";
        }
        
        ?>
      </div>
    </div>
  </body>
</html>
<!--start footer-->
<?php include ('footer.php'); ?>
<!--end footer-->