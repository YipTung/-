<?php
require_once '../comm.php';
check_login();//用户登录检查
visit_power(2);
if (isset($_POST['submit'])){
	add_vote($_POST);
// 	$vote_item == 'option_"+(num)"';
// 	add_vote($_POST['title'],$_POST['start_time'],$_POST['end_time'],$_POST['vote_item']);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>留言板-发起投票</title>
	<link rel="stylesheet" type="text/css" href="../css/lyb.css">
	<style type="text/css"> 
 	#container{ 
 		width: 960px; 
 	} 
 	#navi{
		height: 560px;
	}
	#navi li{
		padding-right: 40px;
	}
 	#info{ 
 		height: 550px;
 		width: 750px;
 		text-align: left;
 		padding-right: 50px;
 	}
	
	</style>
	<script type="text/javascript" src="../jquery-1.11.1.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#add_item').click(function(){
				var option_num = $("#myoption tr").length;
				var option_html = $("#myoption").html();
				if(option_num<5){
					option_html += "<tr><td id='option_"+(option_num+1)+"'>选项"+(option_num+1)+":</td><td><input name='option_"+(option_num+1)+"'></input></td></tr><br/>"
					$("#myoption").html(option_html);
					
				}else{
					alert("至多只能有五个选项哦！");
					
				}
			});
			$('#dele_item').click(function(){
				var curr_options = $("#myoption tr").length;
				if(curr_options>2){
					$("#myoption").find("tr").last().remove();
				}else{
					alert("至少要有两个选项哦！");
					
				}
			});
		});
	</script>
	<script type="text/javascript">
		function check(){
			if(myform.title.value==""){
				alert("投票主题不能为空哦！");
				return false;
			}
			if(myform.end_time.value==""){
				alert("截止时间不能为空哦！");
				return false;
			}
			if(myform.start_time.value==""){
				alert("开始时间不能为空哦！");
				return false;
			}
			if(myform.option_1.value=="" || myform.option_2.value==""){
				alert("至少要有两个选项哦！");
				return false;
			}
			return true;
			
		}
	</script>
</head>
<body>
<center>
<div id="top">
	<h1>发起投票</h1><br/>
	<h5>欢迎您 <?php echo $_SESSION['user']; ?>，请您在此处发起新的投票。</h5><br/>
</div>
<div id="container">
	<div id="navi">
	<ul>
		<li><a href="../person.php">个人中心</a></li>
		<li><a href="../view.php">返回前台</a></li>
		<li><a href="add_vote.php">发起投票</a></li>
		<li><a href="vote_admin.php">投票管理</a></li>
		<li><a href="admin.php">用户管理</a></li>
		<li><a href="ly_admin.php">留言管理</a></li>
		<li><a href="reply_admin.php">回复管理</a></li>
		<li><a href="../login.php?action=out">退出登录</a></li>
	</ul>
	</div>
	<div id="info">
		<form id=myform name=myform action="" method=post onsubmit="return check();">
			<ul>
				<li>投票主题：<input id=title name=title></input>*</li><br/>
				<li>开始时间：<input id=start_time name=start_time value="<?php echo date("Y-m-d H:i:s"); ?>"></input>*[格式：2018-01-08 15:23:16]</li><br/>
				<li>截止时间：<input id=end_time name=end_time value="<?php echo date("Y-m-d H:i:s",time()+7*3600*24); ?>"></input>*[格式：2018-01-08 15:23:16]</li><br/>
				<li>投票选项：</li>
				
				<table id="myoption" >
				<tr>
				<td id="option_1">选项1：</td>
				<td><input name="option_1"></input>*[至少要有两个选项哦]</td><br/>
				</tr>
				<tr>
				<td id="option_2">选项2：</td>
				<td><input name="option_2"></input>*[至多只能有五个选项呢]</td><br/>
				</tr>

				
				</table>
				
				<li>
					<input type="button" id="add_item" value="增加选项"><br/>
					<input type="button" id="dele_item" value="减少选项">
				</li>
				
				<br/><br/>
				
				<li>
					<input type="submit" name="submit" value="发起投票">
					<input type="reset" name="reset" value="重置">
				</li>
				
			</ul>
		</form>
	</div>
</div>
</body>
</html>