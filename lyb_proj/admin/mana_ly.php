<?php
require_once '../comm.php';
$oper = $_GET['oper'];
switch ($oper){
	//管理员屏蔽留言
 	case "pb":
 		$id = $_GET['id'];
 		$sql = "update lyb_info set disp_f = 1 where id=$id";
 		$result = mysqli_query($link, $sql);
 		if ($result){
 			echo "留言屏蔽成功！";
 		}else {
 			echo "留言屏蔽失败！";
 		}
 		break;
	//管理员显示留言
	case "xs":
		$id = $_GET['id'];
		$sql = "update lyb_info set disp_f = 0 where id=$id";
		$result = mysqli_query($link, $sql);
		if ($result){
			echo "留言显示成功！";
		}else {
			echo "留言显示失败！";
		}
		break;
	//管理员删除留言
	case "del":
		$id = $_GET['id'];
		$sql = "delete from lyb_info where id=$id";
		$result = mysqli_query($link, $sql);
		//同时删除该留言下的回复
		$sql_r = "delete from reply_info where ly_id=$id";
		$result_r = mysqli_query($link, $sql_r);
		if ($result && $result_r){
			echo "留言删除成功！";
		}else {
			echo "留言删除失败！";
		}
		break;
}