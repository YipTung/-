<?php
require_once 'comm.php';
$new_pwd = $_GET['pwd'];
$sql = "update user_info set password='".$new_pwd."' where user_name='".$_SESSION['user']."' ";
$result = mysqli_query($link, $sql);
if ($result){
	echo "密码修改成功！";
}else {
	echo "密码修改失败！";
}
?>