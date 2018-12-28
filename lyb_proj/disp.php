<?php
require_once 'comm.php';
require_once 'pages.class.php';
check_login();//用户登录检查
visit_power(2);
$id = $_GET['id'];
$sql = "select * from lyb_info where id='".$id."'";
$result = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc($result);
if (isset($_POST['submit'])) {
	publish_reply($_POST['reply_cont'],$id);
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>留言板-留言详情</title>
	<link rel="stylesheet" type="text/css" href="css/lyb.css">
 	<style type="text/css">
 	#container{ 
 		width: 960px; 
 	} 
 	#navi{
		height: 1960px;
	}
	#navi li{
		padding-right: 40px;
	}
 	#info{ 
 		height: 1950px;
 		width: 750px;
 		text-align: left;
 		padding-right: 50px;
 	}
	</style>
	<script type="text/javascript">
	myDate.toLocaleString( );
		function reply_check(){
			if (myform.reply_cont.value=="") {
				alert("回复内容不能为空！");
				return false;
			}
			return true;
		}
	</script>
</head>
<body>
<center>
<div id="top">
	<h1>留言详情</h1><br/>
	<h5>欢迎您 <?php echo $_SESSION['user']; ?>，欢迎您浏览本留言板，您可以在本页面查看该留言详细信息。</h5><br/>
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
		<form id=myform name=myform action="" method=post onsubmit="return reply_check();">
			<ul>
				<li align="left"><h3>【<?php echo $row['ly_type']; ?>】</h3></li>
				<li align="center"><h3>&nbsp;&nbsp;&nbsp;<?php echo $row['title']; ?></h3></li>
				<li align="center"><h5>楼主：<?php echo $row['author']; ?>&nbsp;&nbsp;&nbsp;发布时间：<?php echo $row['publish_time']; ?></h5></li>
				<li align="left"><?php echo $row['content']; ?></li><br/><br/><br/><br/><br/><br/>
			</ul>
			<br/>

			<?php 
			$each_disNums = 8;  //每页显示八条回复
			$sql = "select * from reply_info where ly_id=$id";
			$result = mysqli_query($link,$sql);
			global $link;
			$nums = mysqli_num_rows($result);
			if (isset($_GET['page'])) {
				$current_page = $_GET['page'];
			}else{
				$current_page=1;
			}
			$sql_r = "select * from reply_info where disp_r=0 and ly_id=$id limit ".($current_page-1)*$each_disNums.",".$each_disNums;
			$result_r = mysqli_query($link,$sql_r);
			$num = 2;
			while ($row = mysqli_fetch_assoc($result_r)) {
			 ?>

			<ul>
				<hr><br/>
				<li align="left"><?php echo $row['reply_cont']; ?></li><br/>
				<li align="right"><h5><?php echo $num++; ?>楼：&nbsp;<?php echo $row['replyer']; ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo $row['reply_time']; ?></h5></li>
			</ul>

			<?php } ?>

			<ul>
				<br/><br/><br/>
				<?php $page = new pages($each_disNums,$nums,$current_page,5,"disp.php?id=".$id."&page=",1); ?>
				<hr><hr>
				<li align="left">发表回复</li><br>
				<li>
							<script type="text/javascript" src="./ckeditor/ckeditor.js"></script>
							<textarea id="reply_cont" name="reply_cont" rows="10" cols="60"></textarea>
							<script type="text/javascript">
								var editor = CKEDITOR.replace("content");
							</script>
				</li><br/>
				<li align="right">
					<input type="submit" name="submit" value="回复">
					<a href="#" onClick="javascript :history.go(-1);"><input type="submit" value="返回"></a>
				</li>
			</ul>
		</form>
	</div>
</div>
</body>
</html>