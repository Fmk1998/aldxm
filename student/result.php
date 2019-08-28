<?php
	header("Content-Type:text/html;charset=GB2312");
	session_start();
	include("dbconfig.php");
	@$studentid=$_SESSION["login"]["id"];//get studentid
	if(empty($studentid)){
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
		</script>
	<body onload="timeset()">
		<div style="background-color: #F0F0F0;height: 90px;">
			<table>
				<tr>
					<td>
						<img src="img/jhlogo.jpg"/>
					</td>
					<td valign="middle">
						<h1 style="margin-left: 400px;">查看选题结果</h1>
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
			<div style="width: 75%;float:right;">
			<?php 
				$con = mysql_connect(HOST,USER,PSW);
				mysql_select_db(dbname,$con);
				mysql_query("set names 'GB2312'");
				$psql = "select * from ptable where sid='".$studentid."'";	//查询项目最终志愿
				$presult = mysql_query($psql,$con);
				$prow =@mysql_fetch_array($presult);
				if(!empty($prow["pfid"])){
					$pfid=$prow['pfid'];
					$tsql = "select * from ttable where pid='".$pfid."'";	//查询老师相关信息
					$tresult = mysql_query($tsql,$con);
					while($trow = @mysql_fetch_array($tresult)){
						$tid=$trow['tid'];
						$teasql = "select Name from teacherdb where Id='".$tid."'";	//查询老师名
						$tearesult = mysql_query($teasql,$con);
						$tearow = @mysql_fetch_array($tearesult);
						echo "<table class='table table-striped table-bordered table-hover' style='width: 60%;margin-top: 15px;'>";
						echo "<tr>";
						echo "<td colspan='2' align='center'><strong>选题结果</strong></td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td><strong>老师名</strong></td>";
						echo "<td>{$tearow['Name']}</td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td><strong>课题名</strong></td>";
						echo "<td>{$trow['ptitle']}</td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td><strong>课题类型</strong></td>";
						echo "<td>{$trow['ptype']}</td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td><strong>课题性质</strong></td>";
						echo "<td>{$trow['pcha']}</td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td><strong>课题来源</strong></td>";
						echo "<td>{$trow['psource']}</td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td valign='top'><strong>主要研究内容</strong></td>";
						echo "<td height='100px' valign='top' width='400px'>{$trow['pcontent']}</td>";
						echo "</tr>";
						echo "</table>";
					}
				}else{
					if(empty($prow))
						echo "<div class=\"alert alert-warning\" style=\"width:80%;margin-top:30px;font-size:24px;\">您还没有填报志愿！</div>";
					else{
						$pid1=$prow["pid1"];
						$pid2=$prow["pid2"];
						$sqlpid1="select ptitle,Name from ttable,teacherdb where pid='".$pid1."' and ttable.tid=teacherdb.Id";
						$sqlpid2="select ptitle,Name from ttable,teacherdb where pid='".$pid2."' and ttable.tid=teacherdb.Id";
						$dosqlpid1=mysql_query($sqlpid1);
						$dosqlpid2=mysql_query($sqlpid2);
						$sqlpid1row=mysql_fetch_array($dosqlpid1);
						$sqlpid2row=mysql_fetch_array($dosqlpid2);
						echo "<table class=\"table table-striped table-bordered table-hover\" style=\"width:80%;margin-top: 20px;position:relative;left:80px;\">";
						echo "<tr>";
						echo "<td colspan='4' align='center'><strong>你还没被选上</strong></td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td align=\"center\" style='width:17%;'><strong></strong></td>";
						echo "<td align=\"center\" style='width:49%;'><strong>题目</strong></td>";
						echo "<td align=\"center\" style='width:17%;'><strong>老师姓名</strong></td>";
						echo "<td align=\"center\" style='width:17%;'><strong>具体信息</strong></td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td align=\"center\"><strong>第一志愿</strong></td>";
						echo "<td align=\"center\"><strong>".$sqlpid1row["ptitle"]."</strong></td>";
						echo "<td align=\"center\"><strong>".$sqlpid1row["Name"]."</strong></td>";
						echo "<form method='POST' action='ckxt.php'>";
						echo "<input type='hidden' value=".$pid1." name='pid'>";
						echo "<td align=\"center\" style='padding: 5px 0;'>";
						echo "<input type='submit' value='查看' class=\"btn btn-primary\" style='margin:0;'>";
						echo "</td>";
						echo "</form>";
						echo "</tr>";
						echo "<tr>";
						echo "<td align=\"center\"><strong>第二志愿</strong></td>";
						echo "<td align=\"center\"><strong>".$sqlpid2row["ptitle"]."</strong></td>";
						echo "<td align=\"center\"><strong>".$sqlpid2row["Name"]."</strong></td>";
						echo "<form method='POST' action='ckxt.php'>";
						echo "<input type='hidden' value=".$pid2." name='pid'>";
						echo "<td align=\"center\" style='padding: 5px 0;'>";
						echo "<input type='submit' value='查看' class=\"btn btn-primary\" style='margin:0;'>";
						echo "</td>";
						echo "</form>";
						echo "</tr>";
						echo "</table>";
					}
				}
			?>
			</div>
		</div>
	</body>

</html>