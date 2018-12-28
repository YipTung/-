<?php
require_once 'comm.php';
require_once 'pages.class.php';
check_login();//用户登录检查
visit_power(2);

$id = $_GET['id'];//获取投票id
$sql_votename = "select title from lyb_vote_main where id='".$id."'";
$result_name = mysqli_query($link,$sql_votename);
$vote_name = mysqli_fetch_array($result_name);//获取投票活动名称
//获取各项的投票人数
$sql_voteitem = "select * from lyb_vote_item where vote_id='".$id."'";
$result_item = mysqli_query($link, $sql_voteitem);
// $row_item_count = mysqli_fetch_array($result_item);
//计算总票数
$sql_sumVote = "select SUM(vote_num) AS sumVote from lyb_vote_item where vote_id='".$id."'";
$result_sumVote = mysqli_query($link, $sql_sumVote);
$row_sumVote = mysqli_fetch_array($result_sumVote);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>留言板-投票详情</title>
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
	<h1>投票详情</h1><br/>
	<h5>欢迎您 <?php echo $_SESSION['user']; ?>，欢迎您浏览本留言板，您可以在本页面查看投票的详细信息。</h5><br/>
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
			<tr style='color:red'>
			<!-- <th align=center>图标</th> -->
			<th align=center><!-- <img height=30 src='images/hot.png' width='30'> --></th>
			<th align=center width="150px"><?php print_r($vote_name['title']); ?></th>
			<th align=center width="50px">结果</th>
			<th align=center width="150px">共<?php echo ($row_sumVote['sumVote']); ?>票</th>
			</tr>
			<?php 
				// mysqli_query($link,"update lyb_vote_main set state=0 where end_time<'".date("Y-m-d H:i:s")."'");
				// $sql = "select * from lyb_vote_main where state=1";
				// $result = mysqli_query($link,$sql);
				$num = 0;
				while ($row_item_count = mysqli_fetch_assoc($result_item)) {  
					echo "<tr>";
					echo "<td align=center>".++$num."</td>";
					echo "<td align=center>".$row_item_count['item_name']."</td>";
					echo "<td align=center>".$row_item_count['vote_num']."票</td>";
					if($row_sumVote['sumVote']==0){
						echo "<td align=center>0%</td>";
						echo "<td align=center><img width='35' height='35' src='images/sad.png'></td>";
						echo "<td align=center>暂时还没有人投票哦</td>";
					}else {
					if ($row_item_count['vote_num']==0){
						echo "<td align=center><img width='95' height='75' src='images/sad2.png'></td>";
						echo "<td align=left>没人投我..</td>";
						echo "<td align=left>0%</td>";
					}else {
						echo "<td align=right><img height=15 src='images/pic.gif' width='".round((100*$row_item_count['vote_num']/$row_sumVote['sumVote']),2)."%'>".round((100*$row_item_count['vote_num']/$row_sumVote['sumVote']),2)."%</td>";
					}
					echo "</tr>";
				
					}
				}
			?>
		</table>
		<ul>
		<li align="right"><a href="#" onClick="javascript :history.go(-1);">返回</a></li>
		</ul>
	</div>
</div>
</body>
</html>