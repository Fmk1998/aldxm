<?php
	header("Content-Type: text/html;charset=gb2312");
    session_start();//开启会话
	if(empty($_SESSION["gly"]["id"])){
        echo "<script>alert('请先登录');window.location.href=\"../denglu/login.php\";</script>";
		exit;
	}
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
	<script>
		function show1(page){
			 var xmlHttp = new XMLHttpRequest();
             xmlHttp.open("get","xtxscx.php?page="+page,true);
             xmlHttp.onreadystatechange = function(){
                 if(xmlHttp.readyState==4){
					show.innerHTML = xmlHttp.responseText;
                 }
             }
             xmlHttp.send();		
		}
		function show2(page){
			 var xmlHttp = new XMLHttpRequest();
             xmlHttp.open("get","tts.php?page="+page,true);
             xmlHttp.onreadystatechange = function(){
                 if(xmlHttp.readyState==4){
					show.innerHTML = xmlHttp.responseText;
                 }
             }
             xmlHttp.send();		
		}
	</script>
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
			<div style="width: 75%;float:right;padding-top:20px;">
			    <button class="btn btn-primary" onclick="show1(1)">以学生分类</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
				<button class="btn btn-primary" onclick="show2(1)">以老师分类</button>
				<div id="show"></div>
			</div>
        </div>
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>