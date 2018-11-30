<?php
 ini_set('display_errors',0);
 error_reporting(E_ALL | E_STRICT);
header("Content-type: text/html; charset=utf-8");
 define("Host", "127.0.0.1");
 define("User","ctf");
 define("Password","ctf");
 define("DateName","ctf");
$connect = mysqli_connect(Host,User,Password,DateName);
 if(!$connect)
 {
 	echo mysqli_error($connect);
 	die('mysql connect error !');
 }
 else
 {
 	$sql = "set names utf8";
 	mysqli_query($connect,$sql);
 }


session_start();

//?????????
$basedir = ''; 

//???????????????
include_once('waf.php');
?>
