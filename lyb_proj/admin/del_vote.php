<?php
$oper = $_GET['oper'];
require_once '../comm.php';
switch ($oper){
	//管理员删除投票以及投票选项
	case "del":
		$id = $_GET['id'];
		$sql = "delete from lyb_vote_main where id=$id";
		$result = mysqli_query($link, $sql);
		//同时删除该投票的所有选项
		$sql_r = "delete from lyb_vote_item where vote_id=$id";
		$result_r = mysqli_query($link, $sql_r);
		if ($result && $result_r){
			echo "该投票删除成功！";
		}else {
			echo "该投票删除失败！";
		}
		break;
		
}