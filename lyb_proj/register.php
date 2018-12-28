<!DOCTYPE html>
<html>
<head>
	<title>留言板-用户注册</title>
	<link rel="stylesheet" type="text/css" href="css/lyb.css">
	<style type="text/css"> 
	
	#footer{
		height: 100px;
	}
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
 		padding-right: 50px;
 	}
	</style>
	<script type="text/javascript">
		function check(){
			if (myform.user.value=="") {
				alert("用户名不能为空！")
				return false;
			}
			if (myform.pwd.value=="" | myform.repwd.value=="") {
				alert("密码不能为空！")
				return false;
			}
			if (myform.repwd.value!=myform.pwd.value) {
				alert("两次密码输入不一致，请重新输入！")
				return false;
			}
			if (myform.phone.value=="") {
				alert("电话不能为空！")
				return false;
			}
			return true;
		}
	</script>
	<script type="text/javascript" src="jquery-1.11.1.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#user").blur(function(){
				var user = $(this).val();
				$.ajax({
					type:"GET",
					url:"check_name.php",
					data:{user_name:user},
					success:function(data){
						$("#u_check").html(data);
						}
					});	
				});
			});
	</script>
<?php
require_once 'comm.php';
if (isset($_POST['submit'])){
    register($_POST['user'],$_POST['pwd'],$_POST['phone'],$_POST['email'],$_POST['intro']);
}
?>
</head>
<body>
<center>
<div id="top">
	<h1>欢迎注册</h1><br/>
	<?php 
	if (isset($_SESSION['user'])) {
		echo "<h5>欢迎您:".$_SESSION['user']." ;</h5>";
	}else{echo "  ";}
	
	?>
	<h5>欢迎您注册本留言板，我们会认真及时处理您的信息，注册成功后会通过电子右键通知您。</h5><br/>
</div>
<div id="container">
	<div id="navi">
	<ul>
		<li><a href="register.php">用户注册</a></li>
		<li><a href="login.php">用户登录</a></li>
		<li><a href="view.php">查看留言</a></li>
		<li><a href="message.php">在线留言</a></li>
		<li><a href="vote.php">参与投票</a></li>
		<li><a href="login.php?action=out">退出登录</a></li>
	</ul>
	</div>
	<div id="info">
		<form id=myform name=myform action="" method=post onsubmit="return check();">
			<ul>
				<li>用户名：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="user" name="user" type="text" > *<span id="u_check" style="color: red;"></span></li><br/>
				<li>请输入密码：	<input id="pwd" name="pwd" type="password"> *</li><br/>
				<li>请确认密码：	<input id="repwd" name="repwd" type="password"> *</li><br/>
				<li>电话：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="phone" name="phone" type="text"> *</li><br/>
				<li>E-mail：	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="email" name="email" type="text"></li><br/>
				<li>个人简介：&nbsp;&nbsp;&nbsp;&nbsp;<textarea id="intro" name="intro" rows="10" cols="23"></textarea></li><br/>
				<li>
					<input type="submit" name="submit" value="注册">
					<input type="reset" name="reset" value="重置">
				</li>
			</ul>
		</form>
	</div>
</div>
<div id="footer"></div>
</body>
</html>