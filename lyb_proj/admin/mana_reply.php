<?php
require_once '../comm.php';
$oper = $_GET['oper'];
switch ($oper){
	//管理员屏蔽回复
 	case "pb":
 		$id = $_GET['id'];
 		$sql = "update reply_info set disp_r = 1 where id=$id";
 		$result = mysqli_query($link, $sql);
 		if ($result){
 			echo "回复屏蔽成功！";
 		}else {
 			echo "回复屏蔽失败！";
 		}
 		break;
	//管理员显示回复
	case "xs":
		$id = $_GET['id'];
		$sql = "update reply_info set disp_r = 0 where id=$id";
		$result = mysqli_query($link, $sql);
		if ($result){
			echo "回复显示成功！";
		}else {
			echo "回复显示失败！";
		}
		break;
	//管理员删除回复
	case "del":
		$id = $_GET['id'];
		$sql = "delete from reply_info where id=$id";
		$result = mysqli_query($link, $sql);
		if ($result){
			echo "回复删除成功！";
		}else {
			echo "回复删除失败！";
		}
		break;
}