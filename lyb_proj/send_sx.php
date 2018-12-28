<?php
require_once 'comm.php';
check_login();//用户登录检查
visit_power(2);
if (isset($_POST['submit'])) {
	send_sx($_POST['sendto'],$_POST['content'],$_SESSION['user']);
}

	
?>
<!DOCTYPE html>
<html>
<head>
	<title>留言板-发送私信</title>
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
			
				
			if(myform.sendto.value==""){
				alert("请填写您要发送私信的人哦！");
				return false;
			}else{
				if(myform.content.value==""){
					alert("私信内容不能为空哦！");
					return false;
				}
				return true;
			}
			
		}
	</script>
</head>
<body>
<center>
<div id="top">
	<h1>发送私信</h1><br/>
	<h5>欢迎您 <?php echo $_SESSION['user']; ?>，您可在本页面向其他用户发送私信。</h5><br/>
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
				<li>发送给：	<input id="sendto" name="sendto" type="text" value="<?php 
					
					if (isset($_GET['id'])){
						echo $_GET['id'];
					}
				?>" ></li><br/>
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
					<input type="submit" name="submit" value="发送私信">
					<input type="reset" name="reset" value="重置">
				</li>
			</ul>
		</form>
	</div>
</div>
</body>
</html>