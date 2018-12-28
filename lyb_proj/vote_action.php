<?php
require_once 'comm.php';
check_login();//用户登录检查
visit_power(2);
?>
<!DOCTYPE html>
<html>
<head>
	<title>留言板-实施投票</title>
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
	<?php 

		$id = $_GET['id']; //获取投票项目的id
		$sql_votename = "select title from lyb_vote_main where id ='".$id."'";
		$result_title = mysqli_query($link, $sql_votename);
		$title = mysqli_fetch_array($result_title);
		$sql_voteitem = "select * from lyb_vote_item where vote_id='".$id."'";
		$result_item = mysqli_query($link,$sql_voteitem);
		if (isset($_POST['submit'])) {
			vote_publish($id,$_POST['myvote']);
		}

	 ?>
</head>
<body>
<center>
<div id="top">
	<h1>在线投票</h1><br/>
	<h5>欢迎您 <?php echo $_SESSION['user']; ?>，请您在此处进行投票选择。</h5><br/>
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
		<form id=myvote name=myvote action="" method=post onsubmit="return check();">
			<ul>
				<li>投票主题：	<?php echo $title[0]; ?></li><br/>
				<li>投票选项：<br/>
				<?php 
				while ($row_item=mysqli_fetch_array($result_item)) {
					echo "<input checked type=radio name=myvote value='".$row_item['id']."'>".$row_item['item_name']."<br/> ";
				}
				?>			
				</li><br/>
				<br/>
				<li>
					<input type="submit" name="submit" value="投票">
					<input type="reset" name="reset" value="重置">
				</li>
			</ul>
		</form>
	</div>
</div>
</body>
</html>
