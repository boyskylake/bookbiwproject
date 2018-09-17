<?php
// $servername = "127.0.0.1";
// $username = "root";
// $password = "";
// $database = "db_book";

// // 127.0.0.1:54917
// // // $servername = "127.0.0.1:53111";
// // $username = "azure";
// // $password = "6#vWHD_$";
// // $database = "db_testapp";


// // Create connection
// $conn = new mysqli($servername, $username, $password, $database);

// if ($conn->connect_error) {
// mysqli_query($conn,"SET NAMES UTF8");
// 	@mysqli_query($conn,"SET NAMES UTF8"); 
// 	@mysqli_query($conn,"SET character_set_results=utf8"); 
// 	@mysqli_query($conn,"SET character_set_client=utf8");
// 	@mysqli_query($conn,"SET character_set_connection=utf8");
// 	@date_default_timezone_set("Asia/Bangkok");
	
//     die("Connection failed: " . $conn->connect_error);
// }

date_default_timezone_set("Asia/Bangkok");
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_book = "localhost";
$database_book = "db_book";
$username_book = "root";
$password_book = "";
$book = mysql_pconnect($hostname_book, $username_book, $password_book) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_query("SET NAMES UTF8"); 

?>