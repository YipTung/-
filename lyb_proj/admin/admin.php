<?php
require_once '../comm.php';
require_once '../pages.class.php';
check_login();//用户登录检查
visit_power(1);
$person = get_person_info();

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
			
		//管理员修改用户权限
			$("select").change(function(){
				var is_change = confirm("确定修改用户权限吗？");
				if (is_change) {
					var new_power = $(this).val();
					var user_id = $(this).attr("id");
					var oper = "modi";
					$.ajax({
						type:"GET",
						url:"change_power.php",
						data:{id:user_id,power:new_power,oper:oper},
						success:function(data){
							alert(data);
						}
					});
				}
			});
		
		//管理员删除用户
		$("button").click(function(){
				var is_del = confirm("确定删除该用户？");
				if (is_del) {
					var user_id = $(this).attr("id");
					var oper = "del";
					$.ajax({
						type:"GET",
						url:"change_power.php",
						data:{id:user_id,oper:oper},
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
	<h1>用户管理</h1><br/>
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
			<tr><th align=center>序号</th><th align=center>用户名</th><th align=center>用户积分</th><th align=center>用户权限</th><th align=center>用户等级</th><th align=center>管理操作</th></tr>
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

				$sql = "select * from user_info where power>".$u_power." limit ".($current_page-1)*$each_disNums.",".$each_disNums;
				$result = mysqli_query($link,$sql);
				$num = 1;
				while ($row=mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td align=center>".$num++."</td>";
					echo "<td align=center>".$row['user_name']."</td>";
					echo "<td align=center>".$row['score']."</td>";
					
					echo "<td align=center>";
					echo "<select id='".$row['id']."' name='u_power'>";
					switch ($row['power']){
						case 1:
							echo "<option value=1 selected>普通管理员</option>";
							echo "<option value=2>普通用户</option>";
							echo "<option value=3>受限用户</option>";
							break;
						case 2:
							echo "<option value=1>普通管理员</option>";
							echo "<option value=2 selected>普通用户</option>";
							echo "<option value=3>受限用户</option>";
							break;
						case 3:
							echo "<option value=1>普通管理员</option>";
							echo "<option value=2>普通用户</option>";
							echo "<option value=3 selected>受限用户</option>";
							break;
					}
					echo "</select>";
					echo "</td>";
					
 					echo "<td align=center>";
					echo get_person_dj($person['user_dj']);
 					echo "</td>";
					echo "<td align=center><button id='".$row['id']."' name='del'>删除</button></td>";
					echo "</tr>";
				}
				echo "<tr><td colspan=6>";
				$page = new pages($each_disNums,$nums,$current_page,5,"admin.php?page=",1);
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