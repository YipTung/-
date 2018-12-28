<?php
$oper = $_GET['oper'];
require_once 'comm.php';
switch ($oper){
	//管理员删除用户
	case "del":
		$id = $_GET['id'];
		$sql = "delete from lyb_sx where id=$id";
		$result = mysqli_query($link, $sql);
		if ($result){
			echo "该私信删除成功！";
		}else {
			echo "该私信删除失败！";
		}
		break;
}