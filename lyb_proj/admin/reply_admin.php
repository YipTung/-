<?php
require_once '../comm.php';
require_once '../pages.class.php';
check_login();//用户登录检查
visit_power(1);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>留言板-后台管理</title>
	<link rel="stylesheet" type="text/css" href="../css/lyb.css">
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
	<script type="text/javascript" src="../jquery-1.11.1.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$("button").click(function(){
			var oper = $(this).attr("id");
			switch(oper){
				//管理员屏蔽回复
				case "oper_pb":
					var is_pb = confirm("您确定要屏蔽该回复吗？");
					var reply_id = $(this).attr("value");
					if(is_pb){
					$.ajax({
						type:"GET",
						url:"mana_reply.php",
						data:{id:reply_id,oper:"pb"},
						success:function(data){
							alert(data);
						}
					});	
					}
					break;
				//管理员显示回复
				case "oper_xs":
					var is_xs = confirm("您确定要显示该回复吗？");
					var reply_id = $(this).attr("value");
					if(is_xs){
					$.ajax({
						type:"GET",
						url:"mana_reply.php",
						data:{id:reply_id,oper:"xs"},
						success:function(data){
							alert(data);
						}
					});
					}
					break;
				//管理员删除回复
				case "oper_del":
					var is_del = confirm("您确定要删除该回复吗？");
					var reply_id = $(this).attr("value");
					if(is_del){
					$.ajax({
						type:"GET",
						url:"mana_reply.php",
						data:{id:reply_id,oper:"del"},
						success:function(data){
							alert(data);
						}
					});
					}
					break;
			}
			window.location.reload();//刷新
		});
	});
	</script>
</head>
<body>
<center>
<div id="top">
	<h1>回复管理</h1><br/>
	<h5>欢迎您 <?php echo $_SESSION['user']; ?>，欢迎您浏览本留言板，您可以在本页面做用户管理和留言、回复留言的管理。</h5><br/>
</div>
<div id="container">
	<div id="navi">
	<ul>
		<li><a href="../person.php">个人中心</a></li>
		<li><a href="../view.php">返回前台</a></li>
		<li><a href="add_vote.php">发起投票</a></li>
		<li><a href="vote_admin.php">投票管理</a></li>
		<li><a href="admin.php">用户管理</a></li>
		<li><a href="ly_admin.php">留言管理</a></li>
		<li><a href="reply_admin.php">回复管理</a></li>
		<li><a href="../login.php?action=out">退出登录</a></li>
	</ul>
	</div>
	<div id="info">
		<table>
			<tr><th align=center>序号</th><th align=center>回复内容</th><th align=center>回复人</th><th align=center>回复时间</th><th align=center>管理操作</th></tr>
			<?php 
				$each_disNums = 16;  //每页显示十六个用户信息
				$u_power = get_user_power(); //获得当前用户权限
				$sql = "select * from user_info where power>".$u_power;
				$result = mysqli_query($link,$sql);
				global $link;
				$nums = mysqli_num_rows($result);
				if (isset($_GET['page'])) {
					$current_page = $_GET['page'];
				}else{
					$current_page=1;
				}

				$sql = "select * from reply_info order by reply_time desc limit ".($current_page-1)*$each_disNums.",".$each_disNums;
// 				$sql2="select * from lyb_info";
				$result = mysqli_query($link,$sql);
				$num = 1;
				while ($row=mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td align=center>".$num++."</td>";
					echo "<td align=center><a href='../disp.php?id=".$row['ly_id']."'>".$row['reply_cont']."</a></td>";
					echo "<td align=center>".$row['replyer']."</td>";
					echo "<td align=center>".$row['reply_time']."</td>";
					echo "<td align=center><button id='oper_del' value='".$row['id']."'>删除</button>";
					if($row['disp_r']==0){
						echo "<button id='oper_pb' value='".$row['id']."'>屏蔽</button>";
					}else {
						echo "<button id='oper_xs' value='".$row['id']."'>显示</button>";
					}
					echo "</td>";
					echo "</tr>";
				}
				echo "<tr><td colspan=6>";
				$page = new pages($each_disNums,$nums,$current_page,5,"reply_admin.php?page=",1);
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