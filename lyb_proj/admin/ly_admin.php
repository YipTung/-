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
 		width: 1090px; 
 	} 
 	#navi{
		height: 560px;
	}
	#navi li{
		padding-right: 40px;
	}
 	#info{ 
 		height: 510px;
 		width: 880px;
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
					//管理员屏蔽留言
					case "oper_pb":
						var is_pb = confirm("您确定要屏蔽该留言吗？");
						var ly_id = $(this).attr("value");
						if(is_pb){
						$.ajax({
							type:"GET",
							url:"mana_ly.php",
							data:{id:ly_id,oper:"pb"},
							success:function(data){
								alert(data);
							}
						});	
						}
						break;
					//管理员显示留言
					case "oper_xs":
						var is_xs = confirm("您确定要显示该留言吗？");
						var ly_id = $(this).attr("value");
						if(is_xs){
						$.ajax({
							type:"GET",
							url:"mana_ly.php",
							data:{id:ly_id,oper:"xs"},
							success:function(data){
								alert(data);
							}
						});
						}
						break;
					//管理员删除留言
					case "oper_del":
						var is_del = confirm("您确定要删除该留言");
						var ly_id = $(this).attr("value");
						if(is_del){
						$.ajax({
							type:"GET",
							url:"mana_ly.php",
							data:{id:ly_id,oper:"del"},
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
	<h1>留言管理</h1><br/>
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
			<tr><th align=center>序号</th><th align=center>标题</th><th align=center>发表人</th><th align=center>发表时间</th><th align=center>留言类型</th><th align=center>管理操作</th></tr>
			<?php 
				$each_disNums = 5;  //每页显示五条留言
				$u_power = get_user_power(); //获得当前用户权限
				$sql = "select * from lyb_info ";
				$result = mysqli_query($link,$sql);
				global $link;
				$nums = mysqli_num_rows($result);
				if (isset($_GET['page'])) {
					$current_page = $_GET['page'];
				}else{
					$current_page=1;
				}

				$sql = "select * from lyb_info order by publish_time desc limit ".($current_page-1)*$each_disNums.",".$each_disNums;
				$result = mysqli_query($link,$sql);
				$num = 1;
				while ($row=mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td align=center>".$num++."</td>";
					echo "<td><a href='../disp.php?id=".$row['id']."'>".$row['title']."</a></td>";
					echo "<td align=center>".$row['author']."</td>";
					echo "<td align=center>".$row['publish_time']."</td>";
					echo "<td align=center>".$row['ly_type']."</td>";
					echo "<td align=center><button id='oper_del' value='".$row['id']."'>删除</button>";
					if($row['disp_f']==0){
						echo "<button id='oper_pb' value='".$row['id']."'>屏蔽</button>";
					}else {
						echo "<button id='oper_xs' value='".$row['id']."'>显示</button>";
					}
					echo "</td>";
					echo "</tr>";
				}
				echo "<tr><td colspan=6>";
				$page = new pages($each_disNums,$nums,$current_page,5,"ly_admin.php?page=",1);
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