<?php
session_start();
date_default_timezone_set("PRC");//设置时区
$link = mysqli_connect("localhost","root","19980322","lyb");
mysqli_query($link, "set names 'utf-8'");

//弹窗跳转
function show_msg($msg,$url){
	$win_str = "<meta http-equiv='refresh' content='3;url=".$url."'>
				<table width='200' border='1' align                                 ='center'>
				<tbody>
					<tr>
						<td style='font-size:16px;text-align:center'>提示窗口</td>
					</tr>
					<tr>
						<td align='center'>".$msg."页面将在3秒后跳转，如跳转失败，请点击<a href='".$url."'><span style='color:blue'>此处</span></a></td>
					</tr>
				</tbody>
				<table>
				";
	echo $win_str;
	exit();
}

//用户注册
function register($user,$pwd,$phone,$email,$intro){
    global $link;
	$sql = "select * from user_info where user_name='".$user."'";
	$result = mysqli_query($link, $sql);
//改用了jQuery的方法
// 	if (mysqli_num_rows($result)>0) {
// 		show_msg("用户名已存在，请重新输入","register.php");
// 	}else{
// 		$sql = "insert into user_info (user_name,password,telephone,email,intro) values('".$user."','".$pwd."','".$phone."','".$email."','".$intro."')";
// 		$result = mysqli_query($link, $sql);
// 	}
  //$pwds=md5($pwd);
	if ($result){
		$sql = "insert into user_info (user_name,password,telephone,email,intro) values('".$user."','".$pwd."','".$phone."','".$email."','".$intro."')";
		$result = mysqli_query($link, $sql); //jquery检测用户名加
	    show_msg("注册成功，请登录！",'login.php');//jquery检测用户名加
	}else {
	    echo "<script>alert('注册失败！')</script>";
	}
}

//用户登录
function login($user,$pwd){
	global $link;
	$sql = "select * from user_info where user_name='".$user."'and password='".$pwd."' ";
	$result = mysqli_query($link, $sql);
	if (mysqli_num_rows($result)>0){
		$_SESSION['user']=$user;
		$_SESSION['pwd']=$pwd;
		show_msg($user.",欢迎登陆留言板！","view.php");
	}else{
		show_msg("密码错误，请重新登录！","login.php");
	}
}

//获取用户的详细信息
function get_person_info(){
	global $link;
	$sql = "select * from user_info where user_name='".$_SESSION['user']."'";
	$result = mysqli_query($link, $sql);
	$row = mysqli_fetch_assoc($result);
	return $row;
}

//获取用户的等级信息
function get_person_dj($dj){
	global $link;
	$sql = "select * from user_dj where id='".$dj."'";
	$result = mysqli_query($link,$sql);
	$row = mysqli_fetch_assoc($result);
	echo $row['dj_name'];
}

//发表留言
function publish_ly($title,$content,$ly_type){
	global $link;
	$sql = "insert into lyb_info(title,content,author,publish_time,ly_type) values('".$title."','".$content."','".$_SESSION['user']."','".date("Y:m:d H:i:s")."','".$ly_type."')";
	$result = mysqli_query($link, $sql);
	if ($result){
		//对用户增加积分
		$sql = "update user_info set score=score+5 where user_name='".$_SESSION['user']."'";
		$res = mysqli_query($link, $sql);
		//判断用户是否升级
		//1、获取用户当前等级
		$curr_sql = "select * from user_info where user_name='".$_SESSION['user']."'";
		$curr_res = mysqli_query($link, $curr_sql);
		$curr_row = mysqli_fetch_assoc($curr_res);
		$curr_dj = $curr_row['user_dj'];//用户当前等级
		$curr_score = $curr_row['score'];//用户当前积分
		//2、获取用户下一等级的积分值
		$next_sql = "select * from user_dj where id=".($curr_dj+1);
		$next_res = mysqli_query($link, $next_sql);
		$next_row = mysqli_fetch_assoc($next_res);
		$next_score = $next_row['dj_score'];//用户下一等级所需的积分
		$next_name = $next_row['dj_name'];//用户下一等级名
		if ($curr_score>=$next_score){
			//更新用户等级
			$upd_sql = "update user_info set user_dj=user_dj+1 where user_name='".$_SESSION['user']."'";
			$upd_res = mysqli_query($link, $upd_sql);
			show_msg("留言成功,积分加5".$_SESSION['user']."升级为".$next_name, "view.php");
		}else { 
			show_msg("留言成功,积分加5", "view.php");
		}
	}else {
		show_msg("留言失败", "message.php");
	}
}

//检查登录状态
function check_login(){
	if(!isset($_SESSION['user'])){
		show_msg("请先登录！","login.php?action=go");
	}
}

//检查用户访问权限
function visit_power($power){
	$user_power = get_user_power();
	if ($user_power>$power) {
		session_destroy();
		show_msg("您没有权限访问本页面！","login.php");
	}
}

//
function get_user_power(){
	// 获取当前用户的权限power
	global $link;
	$sql = "select * from user_info where user_name='".$_SESSION['user']."'";
	$result = mysqli_query($link, $sql);
	$row = mysqli_fetch_assoc($result);
	return $row['power'];
}

//回复留言
function publish_reply($cont,$ly_id){
	global $link;
	$sql = "insert into reply_info(ly_id,replyer,reply_time,reply_cont) values($ly_id,'".$_SESSION['user']."','".date("Y:m:d H:i:s")."','".$cont."')";
	$result = mysqli_query($link,$sql);
	if ($result) {

		//对用户增加积分
		$sql = "update user_info set score=score+2 where user_name='".$_SESSION['user']."'";
		$res = mysqli_query($link, $sql);
		//判断用户是否升级
		//1、获取用户当前等级
		$curr_sql = "select * from user_info where user_name='".$_SESSION['user']."'";
		$curr_res = mysqli_query($link, $curr_sql);
		$curr_row = mysqli_fetch_assoc($curr_res);
		$curr_dj = $curr_row['user_dj'];//用户当前等级
		$curr_score = $curr_row['score'];//用户当前积分
		//2、获取用户下一等级的积分值
		$next_sql = "select * from user_dj where id=".($curr_dj+1);
		$next_res = mysqli_query($link, $next_sql);
		$next_row = mysqli_fetch_assoc($next_res);
		$next_score = $next_row['dj_score'];//用户下一等级所需的积分
		$next_name = $next_row['dj_name'];//用户下一等级名
		if ($curr_score>=$next_score){
			//更新用户等级
			$upd_sql = "update user_info set user_dj=user_dj+1 where user_name='".$_SESSION['user']."'";
			$upd_res = mysqli_query($link, $upd_sql);
			show_msg("回复成功,积分+2，".$_SESSION['user']."升级为".$next_name,"disp.php?id=".$ly_id);
		}else {
			show_msg("发表回复成功！","disp.php?id=".$ly_id);
		}
	}else{
		show_msg("发表回复失败！","disp.php?id=".$ly_id);
	}
}

//发送私信
function send_sx($sendto,$content,$user){
	global $link;
// 	$sql = "select user_name from user_info";
// 	$result = mysqli_query($link,$sql);
// 	$row = mysqli_fetch_array($result);
// 	if ($sendto!=$row['user_name']){
// 		show_msg("请向已注册的用户发送私信!", "send_sx.php");
// 	}else {
// 		echo "ok";
// 	}
	if ($user==$sendto){
 		show_msg("不能给自己发私信哦！", "send_sx.php");
	}else {
			$sql = "insert into lyb_sx(sendto,content,sendfrom,sendtime) values('".$sendto."','".$content."','".$_SESSION['user']."','".date("Y:m:d H:i:s")."')";
			$result = mysqli_query($link, $sql);
			if ($result){
				show_msg("发送私信成功", "sx.php");
			}else {
				show_msg("发送私信失败", "send_sx.php");
			}
	}
}

// 用户投票
function vote_publish($vote_id,$item_id){
	global $link;
	$sql = "update lyb_vote_item set vote_num=vote_num+1 where id='".$item_id."'";
	$result = mysqli_query($link, $sql);
	$item_sql = "select item_name from lyb_vote_item where id='".$item_id."'";
	$item_result = mysqli_query($link, $item_sql);
	$item_row = mysqli_fetch_array($item_result);
	if ($result){
		show_msg("您选择了：<span style='color:red'>[".$item_row['item_name']."]</span>！","vote.php");
	}else{
		show_msg("投票失败！","vote.php");
	}
}

//添加投票
function add_vote(&$vote){
	global $link;
	$arr_length = sizeof($vote);
	//获取标题 开始时间 截止时间
	$num=0;
	$option = array();
	foreach ($vote as $vote_val){
		switch ($num){
			case 0:
				$title = $vote_val;
				break;
			case 1:
				$start_time = $vote_val;
				break;
			case 2:
				$end_time = $vote_val;
				break;
			case ($arr_length-1):
				break;
			default:
				array_push($option,$vote_val);
		}
		$num++;
	}
	$sql = "insert into lyb_vote_main(title,originater,start_time,end_time) values('".$title."','".$_SESSION['user']."','".$start_time."','".$end_time."')";
	$result = mysqli_query($link, $sql);
	//获得投票的id
	$vote_id = mysqli_insert_id($link);
	$flag = false;
	for($i=0;$i<sizeof($option);$i++){
		$flag = mysqli_query($link,"insert into lyb_vote_item(vote_id,vote_num,item_name) values('".$vote_id."','0','".$option[$i]."')");
	}if ($flag && $result){
		show_msg("新增投票项目成功！", "vote_admin.php");
	}else{
		show_msg("新增投票项目失败！", "vote_admin.php");
	}
}




?>