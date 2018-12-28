<?php
require_once 'comm.php';
require_once 'pages.class.php';
check_login();//用户登录检查
visit_power(3);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>留言板-查看留言</title>
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
 		height: 510px;
 		width: 750px;
 		padding-top: 50px;
 		padding-right: 50px;
 	}
	</style>
</head>
<body>
<center>
<div id="top">
	<h1>查看留言</h1><br/>
	<h5>欢迎您 <?php echo $_SESSION['user']; ?>，欢迎您浏览本留言板，您可以在本页面查看自己和其他人的留言。</h5><br/>
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
		<table>
			<tr><th align=center>序号</th><th align=center>留言标题</th><th align=center>留言人</th><th align=center>留言时间</th></tr>
			<?php 
				$each_disNums = 15;  //每页显示十五条留言
				$sql = "select * from lyb_info";
				$result = mysqli_query($link,$sql);
				global $link;
				$nums = mysqli_num_rows($result);
				if (isset($_GET['page'])) {
					$current_page = $_GET['page'];
				}else{
					$current_page=1;
				}

				//按发表时间排序 新的在前面
				$sql = "select * from lyb_info where disp_f =0 order by publish_time desc limit ".($current_page-1)*$each_disNums.",".$each_disNums;
				$result = mysqli_query($link,$sql);
				$num = 1;
				while ($row=mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td align=center>".$num++."</td>";
					echo "<td><a href='disp.php?id=".$row['id']."'>".$row['title']."</a></td>";
					echo "<td align=center><a href='send_sx.php?id=".$row['author']."'>".$row['author']."</a></td>";
					echo "<td>".$row['publish_time']."</td>";
					echo "</tr>";
				}
				echo "<tr><td colspan=4>";
				$page = new pages($each_disNums,$nums,$current_page,5,"view.php?page=",1);
				echo "</td></tr>";
			?>
		</table>
		<ul>
		<li align="right"><a href="#" onClick="javascript :history.go(-1);">返回</a></li>
		</ul>
	</div>
</div>
</body>
</html>