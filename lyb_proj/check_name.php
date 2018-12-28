<?php
require_once 'comm.php';
$user = $_GET['user_name'];
mysqli_query($link, "set names 'utf-8'");
$sql = "select * from user_info where user_name='".$user."'";
$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result)>0){
// 	echo iconv('gb2312', 'utf-8',$user."已存在!");
	echo $user."已存在！";
}else {
	echo iconv('gb2312', 'utf-8', " ");
}