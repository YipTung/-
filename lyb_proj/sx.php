<?php
require_once 'comm.php';
require_once 'pages.class.php';
check_login();//用户登录检查
visit_power(3);
$user = $_SESSION['user'];

$sql = "select * from lyb_sx where view=0 and sendto='".$_SESSION['user']."'";
$result = mysqli_query($link,$sql);
if ($result){
	$sql = "update lyb_sx set view=1 where sendto='".$_SESSION['user']."' ";
	$res = mysqli_query($link, $sql);
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>留言板-查看私信</title>

	<link rel="stylesheet" href="css/reveal.css">
	<script type="text/javascript" src="jquery-1.4.4.min.js"></script>
	<script type="text/javascript" src="jquery.reveal.js"></script>

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
	<script type="text/javascript" src="jquery-1.11.1.min.js"></script>
	<script type="text/javascript">
		//用户点击私信内容弹窗显示
		$(document).ready(function(){
			$(".content").click(function(){
				var content = $(this).html();
				alert(content);
				});

		//用户删除私信
		$("button").click(function(){
				var is_del = confirm("确定删除该私信？");
				if (is_del) {
					var sx_id = $(this).attr("id");
					var oper = "del";
					$.ajax({
						type:"GET",
						url:"del_sx.php",
						data:{id:sx_id,oper:oper},
						success:function(data){
							alert(data);
						}
					});
					window.location.reload();//刷新
			};
		});
});
	</script>
</head>
<body>
<center>
<div id="top">
	<h1>查看私信</h1><br/>
	<h5>欢迎您 <?php echo $_SESSION['user']; ?>，欢迎您浏览本留言板，您可以点击私信内容查看私信的详细内容。<a href='send_sx.php'><span style='color:red'>[发私信]</span></a>  </h5><br/>
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
			<tr><th align=center>序号</th><th align=center>私信内容</th><th align=center>发送人</th><th align=center>发送时间</th></tr>
			<?php 
				$each_disNums = 15;  //每页显示十五条私信
				$sql = "select * from lyb_sx";
				$result = mysqli_query($link,$sql);
				global $link;
				$nums = mysqli_num_rows($result);
				if (isset($_GET['page'])) {
					$current_page = $_GET['page'];
				}else{
					$current_page=1;
				}

				//按发表时间排序 新的在前面
				$sql = "select * from lyb_sx where sendto='".$user."' order by sendtime desc limit ".($current_page-1)*$each_disNums.",".$each_disNums;
				$result = mysqli_query($link,$sql);
				$num = 1;
				while ($row=mysqli_fetch_array($result)) {
					echo "<tr>";
					echo "<td align=center>".$num++."</td>";
					//内容大于50省略
					$str_len = strlen($row['content']);
					if ($str_len>50){
						if ($str_len%2==0){
							echo "<td class=content align=center>".substr($row['content'], 0,39)."...</td>";
						}else {
							echo "<td class=content align=center>".substr($row['content'], 0,40)."...</td>";
						}
					}else {
						echo "<td class=content align=center>".$row['content']."</td>";
					}
					echo "<td align=center><a href='send_sx.php?id=".$row['sendfrom']."'>".$row['sendfrom']."</a></td>";
					echo "<td align=center>".$row['sendtime']."</td>";
					echo "<td align=center><button id='".$row['id']."' name='del'>删除</button></td>";
					echo "</tr>";
				}
				echo "<tr><td colspan=4>";
				$page = new pages($each_disNums,$nums,$current_page,5,"sx.php?page=",1);
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