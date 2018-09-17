<?php include('chkm.php');?>
<?php include('hh.php');?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
    body,td,th {
	font-family: Lato, "Helvetica Neue", Helvetica, Arial, sans-serif;
}
body {
	background-image: url(../img/huayi.jpg_640x640.jpg);
}
    </style>
    <?php include('css.php');?>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <?php include('datatable.php'); ?>
          <?php include('h.php');?>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <?php include('menu_left.php');?>
        </div>
        <?php
        // @$act=$_GET['act'];
        // if($act=='rd'){
        // echo "<div class='col-md-6'>";
        //   echo "<br />";
        //   include('report_day.php');
        // echo "</div>";
        // }elseif($act=='rfd'){
        // echo "<div class='col-md-7'>";
        //   echo "<br />";
        //   include('report_day2.php');
        // echo "</div>";
        // }else{
        // echo "<div class='col-md-6'>";
        //   echo "<br />";
        //   include('report_list.php');
        // echo "</div>";
        // }
        
        ?>
      </div>
    </div>
  </body>
</html>
<!--start footer-->
<?php include ('footer.php'); ?>
<!--end footer-->