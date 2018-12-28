<?php
require_once 'comm.php';
check_login();//用户登录检查
visit_power(3);
$person = get_person_info();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>留言板-个人中心</title>
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
	<script type="text/javascript" src="jquery-1.11.1.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			var pwd=$("#pwd").val();
			$("#pwd").blur(function(){
			var new_pwd=$(this).val();
			if(pwd!=new_pwd){
				if (confirm("确定修改密码？")){ 
					var new_pwd = $(this).val();
					$.ajax({
						type:"GET",
						url:"change_pwd.php",
						data:{pwd:new_pwd},
						success:function(data){
							alert(data);
						}
					});
				}
			  }
			window.location.reload();//刷新
			});
		});
		
	</script>
</head>
<body>
<center>
<div id="top">
	<h1>个人中心</h1><br/>
	<h5>欢迎您 <?php echo $_SESSION['user']; ?>，您可在本页面查看或修改个人信息。<a href='sx.php'><span style='color:red'>
	[查看私信]
	<?php
		$sql = "select * from lyb_sx where view=0 and sendto='".$_SESSION['user']."'";
		$result = mysqli_query($link,$sql);
		if(mysqli_num_rows($result)>0){
			echo "<img src='images/newmsg.png' width='35px' height='35px'>";
		}
	?>
	</span></a></h5><br/>
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
				<li>用户名：<?php echo $_SESSION['user']; ?></li><br/>
				<li>密码：<?php echo '<input type="password" id="pwd" name="pwd" value="'.$_SESSION['pwd'].'">'; ?></li><br/>
				<li>电话：<?php echo $person['telephone']; ?></li><br/>
				<li>E-mail：<?php echo $person['email']; ?></li><br/>
				<li>个人简介：<?php echo $person['intro']; ?></li><br/>
				<li>积分：<?php echo $person['score']; ?></li><br/>
				<li>用户等级：<?php get_person_dj($person['user_dj']); ?></li><br/>
				<li>
				用户权限：<?php 
			switch ($person['power']){
				case 0:
					echo "超级管理员";
					$win_str = "&nbsp;&nbsp;&nbsp;<a href='admin/admin.php'><span style='color:red'>点击进入后台管理</span></a>";
					echo $win_str;
					exit();
					break;
				case 1:
					echo "普通管理员";
					$win_str = "&nbsp;&nbsp;&nbsp;<a href='admin/admin.php'><span style='color:red'>点击进入后台管理</span></a>";
					echo $win_str;
					exit();
					break;
				case 2:
					echo "普通用户";
					break;
				case 3:
					echo "受限用户";
					break;
				default:
					echo "非法用户";
			}
			?>
				</li><br/>
				<li align="right"><a href="#" onClick="javascript :history.go(-1);">返回</a></li>
			</ul>
		</form>
	</div>
</div>
</body>
</html>