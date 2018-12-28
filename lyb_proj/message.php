<?php
require_once 'comm.php';
check_login();//用户登录检查
visit_power(2);
if (isset($_POST['submit'])) {
	//print_r($_POST);
	publish_ly($_POST['title'],$_POST['content'],$_POST['ly_type']);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>留言板-在线留言</title>
	<link rel="stylesheet" type="text/css" href="css/lyb.css">
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
	<script type="text/javascript">
		function check(){
			if(myform.title.value==""){
				alert("标题不能为空");
				return false;
			}
			for(instance in CKEDITOR.instances){
				CKEDITOR.instances[instance].updateElement();
			}
			if(document.getElementById("content").value==""){
				alert("内容不能为空");
				return false;
			}
			return true;
		}
	</script>
</head>
<body>
<center>
<div id="top">
	<h1>欢迎留言</h1><br/>
	<h5>欢迎您 <?php echo $_SESSION['user']; ?>，欢迎您在本留言板留言。</h5><br/>
</div>
<div id="container">
	<div id="navi">
	<ul>
		<li><a href="person.php">个人中心</a></li>
		<li><a href="sx.php">查看私信</a></li>
		<li><a href="view.php">查看留言</a></li>
		<li><a href="message.php">在线留言</a></li>
		<li><a href="vote.php">参与投票</a></li>
		<li><a href="login.php?action=out">退出登录</a></li>
	</ul>
	</div>
	<div id="info">
		<form id=myform name=myform action="" method=post onsubmit="return check();">
			<ul>
				<li>标题：	<input id="title" name="title" type="text"></li><br/>
				<li>类型：		
							<input id="ly_type" name="ly_type" type="radio" value="杂谈" checked>杂谈
							<input id="ly_type" name="ly_type" type="radio" value="新闻">新闻
							<input id="ly_type" name="ly_type" type="radio" value="经济">经济
							<input id="ly_type" name="ly_type" type="radio" value="旅游">旅游
							<input id="ly_type" name="ly_type" type="radio" value="时尚">时尚
							<input id="ly_type" name="ly_type" type="radio" value="情感">情感
							<input id="ly_type" name="ly_type" type="radio" value="故事">故事
				</li><br/>
				<li>内容：</li><br/>
				<li>
							<script type="text/javascript" src="./ckeditor/ckeditor.js"></script>
							<textarea id="content" name="content" rows="10" cols="60"></textarea>
							<script type="text/javascript">
								var editor = CKEDITOR.replace("content");
							</script>
				</li><br/>
				<br/>
				<li>
					<input type="submit" name="submit" value="提交留言">
					<input type="reset" name="reset" value="重置">
				</li>
			</ul>
		</form>
	</div>
</div>
</body>
</html>