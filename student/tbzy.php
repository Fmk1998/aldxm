<?php
    header("Content-Type: text/html;charset=gb2312");
	session_start();
	include("dbconfig.php");
    $con = mysql_connect(HOST,USER,PSW);
    mysql_select_db(dbname,$con);
    mysql_query("set names 'GB2312'");
	if(empty($_SESSION["login"]["id"])){
        echo "<script>alert('请先登录');window.location.href=\"../denglu/login.php\";</script>";
		exit;
	}
?>
<!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>毕业生管理系统</title>
		<style>
			#ftable tr td{
				padding-top:25px;
				padding-bottom:25px;
			}
		</style>
	</head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link type="text/css" href="css/index.css" rel="stylesheet" />
	<script type="text/javascript" src="js/index.js"></script>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript">
		var checktime=function(){		    
			$.ajax({
			    type:"GET",
			    url:"dealwithmessage.php", 
			    dataType:'json',
			    success:update_page1
			});
		}
		function update_page1(json){
		    var str="";
			if(json[2]==0)
				str="(已截止)";
			else if(json[2]==1)
				str="(进行中)";
			else if(json[2]==2)
				str="(未开始)";
			$('#j').html(str);
			for(var i=5;i<14;i++){
				if(json[i]==0)
				  str="(已截止)";
				else if(json[i]==1)
					str="(进行中)";
				else if(json[i]==2)
					str="(未开始)";
				if(i==5)
					$('#a').html(str);
				else if(i==6)
					$('#b').html(str);
				else if(i==7)
					$('#c').html(str);
				else if(i==8)
					$('#d').html(str);
				else if(i==9)
					$('#e').html(str);
				else if(i==10)
					$('#f').html(str);
				else if(i==11)
					$('#g').html(str);
				else if(i==12)
					$('#h').html(str);
				else if(i==13)
					$('#i').html(str);
			}
		}
		function timeset(){
			checktime();
			setInterval('checktime()',10000);
		}
		function setSecond1(){
			$.ajax({
				type:"GET",
				url:"tbzy_ht.php?action=kt",
				data:{tidfirst:$("#first1").val()},
				dataType:'json',
				success:update1
			});
		}
		function update1(json){
			var ktstr="";
			ktstr+="<select name=\"pid1\" class=\"selectpicker show-tick form-control\" style=\"width:200px;\">";
			ktstr+="<option value=''>请选择课题</option>";
			for (var i = 0; json[i]; i++) {
				var pidx=json[i]["pid"];
				ktstr+="<option value="+pidx+">" +json[i]["ptitle"]+ "</option>";	
			}
			if(i==0){
				ktstr+="<option value=''>无课题</option>";
			}
			ktstr+="</select>";
			$("#second1").html(ktstr);
			var obj = document.getElementById("btnB");
			obj.style.cssText = "padding-left:215px;";
		}

		function setSecond2(){
			$.ajax({
			  type:"GET",
			  url:"tbzy_ht.php?action=kt",
			  data:{tidfirst:$("#first2").val()},
			  dataType:'json',
			  success:update2
			});
		}
		function update2(json){
			var ktstr2="";
			ktstr2+="<select name=\"pid2\" class=\"selectpicker show-tick form-control\" style=\"width:200px;\">";
			ktstr2+="<option value=''>请选择课题</option>";
			for (var j = 0; json[j]; j++) {
				var pidy=json[j]["pid"];
				ktstr2+="<option value="+pidy+">" + json[j]["ptitle"] + "</option>";	
			}
			if(j==0){
				ktstr2+="<option value=''>无课题</option>";
			}
			ktstr2+="</select>";
			$("#second2").html(ktstr2);
			var obj = document.getElementById("btnB");
			obj.style.cssText = "padding-left:215px;";
		}
		function checkxt(){
			var xt1=document.getElementById("pid1");
			var xt2=document.getElementById("pid2");
			
			if(window.confirm("确认要提交吗？")){
				if(xt1.value==""||xt2.value==""){
					alert("请填报完整");
					return false;
				}
				if(xt1.value==xt2.value){
					alert("两个志愿不能相同"+xt1.value+"AA"+xt2.value);
					return false;
					
				}else{
					return true;
				}
			}else{
				return false;
			}
			
		}
	</script>
	<body onload="timeset()">
		<div style="background-color: #F0F0F0;height: 90px;">
			<table>
				<tr>
					<td>
						<img src="img/jhlogo.jpg"/>
					</td>
					<td valign="middle">
						<h1 style="margin-left: 400px;">填报志愿</h1>
					</td>
				</tr>
			</table>
			<ul class="nav nav-tabs" style="width: 20%;float: right;margin-top:-32px;">
				<li><a href="../denglu/update.php">修改密码</a></li>
				<li><a href="../denglu/cleansession.php">退出系统</a></li>
		</div>
		<div>
			<div style="width: 18%;float:left;">
				<ul class="nav nav-tabs nav-stacked">
					<li onmouseover="Seover(this)" onmouseout="Seout(this)"><a>毕业设计选题<span class="caret"></span></a>
						<ul class="nav nav-tabs nav-stacked">
							<li><a href="xtck.php">查看选题</a></li>
							<li><a href="../tjwj/sjpd.php?taskid=2">填报选题志愿<font id="j"></font></a></li>
						</ul>
					</li>
					<li onmouseover="Seover(this)" onmouseout="Seout(this)"><a>选择任务环节<span class="caret"></span></a>
						<ul class="nav nav-tabs nav-stacked">
							<li><a href="../tjwj/sjpd.php?taskid=5">任务书<font id="a"></font></a></li>
							<li><a href="../tjwj/sjpd.php?taskid=6">开题报告<font id="b"></font></a></li>
							<li><a href="../tjwj/sjpd.php?taskid=7">文献综述<font id="c"></font></a></li>
							<li><a href="../tjwj/sjpd.php?taskid=8">外文翻译<font id="d"></font></a></li>
							<li><a href="../tjwj/sjpd.php?taskid=9">中期检查表<font id="e"></font></a></li>
							<li><a href="../tjwj/sjpd.php?taskid=10">毕业论文第一版<font id="f"></font></a></li>
							<li><a href="../tjwj/sjpd.php?taskid=11">毕业论文第二版<font id="g"></font></a></li>
							<li><a href="../tjwj/sjpd.php?taskid=12">毕业论文第三版<font id="h"></font></a></li>
							<li><a href="../tjwj/sjpd.php?taskid=13">其它<font id="i"></font></a></li>
						</ul>
					</li>
					<li onmouseover="Seover(this)" onmouseout="Seout(this)"><a>功能选项<span class="caret"></span></a>
						<ul class="nav nav-tabs nav-stacked">
							<li><a href="mbxz.html">模板下载</a></li>
						</ul>
					</li>
					<li onmouseover="Seover(this)" onmouseout="Seout(this)"><a>查看结果<span class="caret"></span></a>
						<ul class="nav nav-tabs nav-stacked">
							<li><a href="result.php">查看选题结果</a></li>
							<li><a href="teacherbrief.php">指导老师评语</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<div style="width: 82%;float:right;">
				<form action="tbzy_ht.php?action=submit" method="post" style="position:relative;top:50px;">
					<table style="width:60%;height:50%;position:relative;left:150px;top:-10px;" border="0" id="ftable">
					<tr>
						<td style="width:100px;"><strong>志愿一：</strong></td>
						<td style="width:150px;">
						<select id="first1" onchange="setSecond1()" class="selectpicker show-tick form-control" style="width:150px;">
							<option value="">--请选择老师--</option>
							<?php
							$sql=mysql_query("select * from teacherdb");
							while ($row=mysql_fetch_assoc($sql)) {
								$id=$row["Id"];
								echo "<option value=".$id.">".$row["Name"]."</option>";
							}
							?>
						</select>
						</td>
						<td id="second1" style="width:300px;">
						</td>
					<tr>
						<td><strong>志愿二：</strong></td>
						<td>
						<select id="first2" onchange="setSecond2()" class="selectpicker show-tick form-control" style="width: 150px;">
							<option value="">--请选择老师--</option>
							<?php
							$con = mysql_connect(HOST,USER,PSW);
							mysql_select_db(dbname,$con);
							mysql_query("set names 'GB2312'");
							$sql=mysql_query("select * from teacherdb");
							while ($row=mysql_fetch_assoc($sql)) {
								$id=$row["Id"];
								echo "<option value=".$id.">".$row["Name"]."</option>";
							}
							?>
						</select>
						</td>
						<td id="second2">
						</td>
					</tr>
					<tr>
						<td id="btnB" colspan="3" style="padding-left:120px;">
						<button type="submit" onClick="return checkxt()" class="btn btn-primary" style="width:150px;">提交</button>
						</td>
					</tr>
					</table>
				</form>
			</div>
		</div>
	</body>

</html>