<?php
$oper = $_GET['oper'];
require_once '../comm.php';
switch ($oper){
	//管理员修改用户权限
	case "modi":
		$id = $_GET['id'];
		$power = $_GET['power'];
		$sql = "update user_info set power=".$power." where id=$id";
		$result = mysqli_query($link, $sql);
		if ($result){
			echo "用户权限修改成功！";
		}else {
			echo "用户权限修改失败！";
		}
		break;
	//管理员删除用户
	case "del":
		$id = $_GET['id'];
		$sql = "delete from user_info where id=$id";
		$result = mysqli_query($link, $sql);
		if ($result){
			echo "用户删除成功！";
		}else {
			echo "用户删除失败！";
		}
		break;
}