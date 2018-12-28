<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>留言板-用户登陆</title>
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
 		
 		padding-right: 50px;
 	}
	</style>
	<script type="text/javascript">
		function check(){
			if (myform.user.value=="") {
				alert("用户名不能为空！")
				return false;
			}
			if (myform.pwd.value=="") {
				alert("密码不能为空！")
				return false;
			}
			return true;
		}
		
	</script>
<?php
require_once 'comm.php';
if (isset($_GET['action'])) {
	if ($_GET['action']=="out") {
		unset($_SESSION['user']);
		unset($_SESSION['pwd']);
		session_destroy();
		//echo ("<script type=\"text/javascript\">");
		// 	echo ("function fresh_page()");
		// 	echo ("{");
// 		echo ("window.location.reload();");
		// 	echo ("}");
		// 	echo ("setTimeout('fresh_page()',1000);");
// 		echo ("</script>");
		//echo "123";
// 		exit();
	}
	
}
if (isset($_POST['submit'])){
    login($_POST['user'],$_POST['pwd']);
}
?>
</head>
<body>
<center>
<div id="top">
	<h1>欢迎登陆</h1><br/>
	<?php 
	if (isset($_SESSION['user'])) {
		echo "<h5>欢迎您:".$_SESSION['user']." ;</h5>";
	}else{echo "  ";}
	
	?>
	<h5>欢迎您登陆本留言板。</h5><br/>
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
		<form id=myform name=myform action="" method=post >
		<br/>
		<br/>
			<ul>
				<li class="info"></li>
				<li class="txt">用户名：<input name="user" tabindex="1" id="user" type="text" size="16" emsg=""> *</li><br>
				<li class="txt">密　码：<INPUT name="pwd" tabindex="2" id="pwd" type="password" size="16"> *</li>
<!-- <A style="color: rgb(78, 127, 167); margin-left: 3px;" href="http://my.gdqy.edu.cn/getBackPassword.portal">忘记密码?</A> -->
				<br/>
<!-- 				<li>保存登录状态<br/> -->
<!-- 					<input name="status" type="radio" value='no'>不保存 -->
<!-- 					<input name="status" type="radio" value='day'>保存一天 -->
<!-- 					<input name="status" type="radio" value='week'>保存一周 -->
<!-- 				</li> -->
<!-- 				<br/> -->
				<li>
				<input name="submit"  type="submit" value="登陆">
				<input type="reset" value="重　置">
				</li>
			</ul>
		</form>
	</div>
</div>
</body>
</html>