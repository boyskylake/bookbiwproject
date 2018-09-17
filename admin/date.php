<?php
$datestart="2016-11-22";
$dateend="2016-11-23";

$calculate =strtotime("$dateend")-strtotime("$datestart");
$summary=floor($calculate / 86400); // 86400 มาจาก 24*360 (1วัน = 24 ชม.)
echo "$summary วัน";
?>