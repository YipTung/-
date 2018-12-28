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
	<title>留言板-参与投票</title>
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
	<h1>参与投票</h1><br/>
	<h5>欢迎您 <?php echo $_SESSION['user']; ?>，欢迎您浏览本留言板，您可以在本页面参与投票，发表自己的意见和建议。</h5><br/>
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
			<tr><th align=center>序号</th><th align=center>投票主题</th><th align=center>发起人</th><th align=center>投票截止时间</th><th align=center>参与人数</th></tr>
			<?php 
				mysqli_query($link,"update lyb_vote_main set state=0 where end_time<'".date("Y-m-d H:i:s")."'");
				$sql = "select * from lyb_vote_main where state=1";
				$result = mysqli_query($link,$sql);
				$each_disNums = 15;  //每页显示十五个投票
				global $link;
				$nums = mysqli_num_rows($result); //总共条数
				//当前页数默认为1
				if (isset($_GET['page'])) {
					$current_page = $_GET['page'];
				}else{
					$current_page=1;
				}

				//按截至投票时间排序 快截止的在前面 显示
				$sql = "select * from lyb_vote_main where state =1 order by end_time asc limit ".($current_page-1)*$each_disNums.",".$each_disNums;
				$result = mysqli_query($link,$sql);
				$num = 1;
				while ($row=mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td align=center>".$num++."</td>";
					echo "<td align=center><a href='vote_action.php?id=".$row['id']."'>".$row['title']."</a></td>";
					echo "<td align=center><a href='send_sx.php?id=".$row['originater']."'>".$row['originater']."</a></td>";
					echo "<td align=center>".$row['end_time']."</td>";
					echo "<td align=center>"."参与人数"."</td>";
					echo "<td><a style='color:red' href='vote_info.php?id=".$row['id']."'>"."[详情]"."</a></td>";
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