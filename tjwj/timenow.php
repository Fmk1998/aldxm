<?php
    session_start();//开启会话
	header("Content-Type: text/html;charset=gb2312");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>毕业生管理系统</title>
	</head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link type="text/css" href="css/index.css" rel="stylesheet" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script src="laydate/laydate.js"></script>
	<body>
		<div style="background-color: #F0F0F0;height: 90px;">
			<img src="img/jhlogo.jpg" />
			<ul class="nav nav-tabs" style="width: 20%;float: right;margin-top: 49px;background-color: #F0F0F0;">
				<li><a href="../denglu/update.php">修改密码</a></li>
				<li><a href="../denglu/cleansession.php">退出系统</a></li>
			</ul>
		</div>
        <div>
			<div style="width: 18%;float:left;">
				<ul class="nav nav-tabs nav-stacked">
					<li><a href="insertime.html">设置时间</a></li>
					<li><a href="timenow.php">查看时间</a></li>
					<li><a href="xtzl.php">选题总览</a></li>
					<li><a href="fpxs.php">分配选题学生</a></li>
				</ul>
			</div>
			<div style="width: 82%;float:right;">
				<table class="table table-striped table-bordered table-hover" style="width:60%; margin-top: 20px;margin-left: 10%;">
            	<?php
					if(empty($_SESSION["gly"]["id"]))
						echo "<script>alert('请先登录');window.location.href=\"../denglu/login.php\";</script>";
					else{
						include ("dbconfig.php");
						$con=mysql_connect(HOST,USER,PASS);//连接数据库
						mysql_select_db(DBNAME,$con);//选择数据库
						mysql_query("set names 'gb2312'");
						$sql="select * from timedb";
						$result=mysql_query($sql);

						echo "<tr>
						<th>&nbsp;</th>
						<th>开始时间</th>
						<th>截止时间</th>
						</tr>";
						while($row=@mysql_fetch_array($result)){
							echo "<tr>";
							if($row["taskid"]==1)
								$task="选题申报";
							else if($row["taskid"]==2)
								$task="学生选题";
							else if($row["taskid"]==3)
								$task="第一轮筛选";
							else if($row["taskid"]==4)
								$task="第二轮筛选";
							else if($row["taskid"]==5)
								$task="任务书";
							else if($row["taskid"]==6)
								$task="开题报告";
							else if($row["taskid"]==7)
								$task="文献综述";
							else if($row["taskid"]==8)
								$task="外文翻译";
							else if($row["taskid"]==9)
								$task="中期检查表";
							else if($row["taskid"]==10)
								$task="毕业论文第一版";
							else if($row["taskid"]==11)
								$task="毕业论文第二版";
							else if($row["taskid"]==12)
								$task="毕业论文第三版";
							else if($row["taskid"]==13)
								$task="其他";
							echo "<td>".$task."</td>";
							echo "<td>".date("Y/m/d H:i",$row['starttime'])." </td>";  
							echo "<td>".date("Y/m/d H:i",$row['endtime'])." </td>";  
							echo "</tr>";
						}
					}
					mysql_close($con);
				?>
				</table>
			</div>
        </div>
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>