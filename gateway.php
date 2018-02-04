<?php
session_start();
include 'authent.php';
include 'database.php';
if(isset($_POST["login"]))
{

$chitid=$_POST["chitid"];
$_SESSION["chitid_eway"]=$_POST["chitid"];

$chitamount=$_POST["chitamount"];
$_SESSION["chitamount_eway"]=$_POST["chitamount"];

$totalchits=$_POST["totalchits"];
$_SESSION["totalchits_eway"]=$_POST["totalchits"];

$closedate=$_POST["closedate"];
$_SESSION["closedate_eway"]=$_POST["closedate"];

$opendate=$_POST["opendate"];
$_SESSION["opendate_eway"]=$_POST["opendate"];

$maxmonths=$_POST["maxmonths"];
$_SESSION["maxmonths_eway"]=$_POST["maxmonths"];
$_SESSION["maxmonths_eway"]=$_SESSION["maxmonths_eway"]-1;
$premium=$_POST["premium"];
$_SESSION["premium_eway"]=$_POST["premium"];

$save_type=$_POST["save_type"];
$_SESSION["save_type_eway"]=$_POST["save_type"];


}

?>
