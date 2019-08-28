<?php
    session_start();//开启会话
	@header("Content-type: text/html; charset=gb2312"); 
?>
<?php
	include ("dbconfig.php");
	$con = mysql_connect(HOST,USER,PSW);
	mysql_select_db(dbname,$con);
	mysql_query("set names 'GB2312'");
	@$studentid=$_SESSION["login"]["id"];//get studentid
	if(empty($studentid)){
		echo "<script>alert('请先登录');window.location.href=\"../denglu/login.php\";</script>";
		exit;
	}
	$taskid=@$_GET["taskid"];
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
			function getselect(){
				var str="";
				var task=$('#testSelect option:selected').val();
				location.href="teacherbrief.php?taskid="+task;
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
						<h1 style="margin-left: 400px;">指导老师评语</h1>
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
			<div style="width: 78%;float:right;padding-top:25px;">
				<table class='table table-striped table-bordered table-hover' style='width: 60%;margin-top: 15px;'>
					<tr>
						<td align="center"><strong>请选择任务:</strong></td>
						<td align="center">
							<select name="taskid" id="testSelect" onchange="getselect()">
								<option>------</option>
								<option value="5">任务书</option>
								<option value="6">开题报告</option>
								<option value="7">文献综述</option>
								<option value="8">外文翻译</option>
								<option value="9">中期检查表</option>
								<option value="10">毕业论文第一版</option>
								<option value="11">毕业论文第二版</option>
								<option value="12">毕业论文第三版</option>
								<option value="13">其他</option>
							</select>
						</td>
					</tr>
					<tr>
						<?php
							if(!empty($taskid))
								echo "<td align='center'><strong>当前查看的任务为:</strong></td>";
							if($taskid==5)
								echo "<td align='center'>任务书</td>";
							else if($taskid==6)
								echo "<td align='center'>开题报告</td>";
							else if($taskid==7)
								echo "<td align='center'>文献综述</td>";
							else if($taskid==8)
								echo "<td align='center'>外文翻译</td>";
							else if($taskid==9)
								echo "<td align='center'>中期检查表</td>";
							else if($taskid==10)
								echo "<td align='center'>毕业论文第一版</td>";
							else if($taskid==11)
								echo "<td align='center'>毕业论文第二版</td>";
							else if($taskid==12)
								echo "<td align='center'>毕业论文第三版</td>";
							else if($taskid==13)
								echo "<td align='center'>其它</td>";
						?>
					</tr>
					<?php
						if(empty($taskid)){
							$sql1="select * from filedb where studentid='$studentid'";
							$result1=mysql_query($sql1);
							$result2=mysql_query($sql1);
							$rowp=@mysql_fetch_array($result2);
							if(empty($rowp)){
								echo "<tr><td align='center' colspan='2'>未上传文件！</td></tr>";
							}
							else{
								while($row1=@mysql_fetch_array($result1)) 
									$row2=$row1;
								if(@$row2['state']==1){
									if($row2['task']==5)
										echo "<tr><td align='center' colspan='2'>任务书评审已通过</td></tr>";
									else if($row2['task']==6)
										echo "<tr><td align='center' colspan='2'>开题报告评审已通过</td></tr>";
									else if($row2['task']==7)
										echo "<tr><td align='center' colspan='2'>文献综述评审已通过</td></tr>";
									else if($row2['task']==8)
										echo "<tr><td align='center' colspan='2'>外文翻译评审已通过</td></tr>";
									else if($row2['task']==9)
										echo "<tr><td align='center' colspan='2'>中期检查表评审已通过</td></tr>";
									else if($row2['task']==10)
										echo "<tr><td align='center' colspan='2'>毕业论文第一版评审已通过</td></tr>";
									else if($row2['task']==11)
										echo "<tr><td align='center' colspan='2'>毕业论文第二版评审已通过</td></tr>";
									else if($row2['task']==12)
										echo "<tr><td align='center' colspan='2'>毕业论文第三版评审已通过</td></tr>";
									else if($row2['task']==13)
										echo "<tr><td align='center' colspan='2'>其它评审已通过</td></tr>";
									echo "<tr><td valign='top'><strong><center>指导老师评审意见:</center></strong></td><td height='100px' valign='top' width='400px'>".$row2["brief"]."</td>";
								}
								else if(@$row2["state"]==2){
									if($row2['task']==5)
										echo "<tr><td align='center' colspan='2'>任务书评审未通过</td></tr>";
									else if($row2['task']==6)
										echo "<tr><td align='center' colspan='2'>开题报告评审未通过</td></tr>";
									else if($row2['task']==7)
										echo "<tr><td align='center' colspan='2'>文献综述评审未通过</td></tr>";
									else if($row2['task']==8)
										echo "<tr><td align='center' colspan='2'>外文翻译评审未通过</td></tr>";
									else if($row2['task']==9)
										echo "<tr><td align='center' colspan='2'>中期检查表评审未通过</td></tr>";
									else if($row2['task']==10)
										echo "<tr><td align='center' colspan='2'>毕业论文第一版评审未通过</td></tr>";
									else if($row2['task']==11)
										echo "<tr><td align='center' colspan='2'>毕业论文第二版评审未通过</td></tr>";
									else if($row2['task']==12)
										echo "<tr><td align='center' colspan='2'>毕业论文第三版评审未通过</td></tr>";
									else if($row2['task']==13)
										echo "<tr><td align='center' colspan='2'>其它评审未通过</td></tr>";
									echo "<tr><td valign='top'><strong><center>指导老师评审意见:</center></strong></td><td height='100px' valign='top' width='400px'>".$row2["brief"]."</td>";//find and printf brief
									$wordname=$row2["filename"];//file's name
									@unlink("uploads/".$wordname);//delete file
								}
								else if(@$row2["state"]==0){
									echo "<tr>";
									echo "<td align='center'><strong>当前查看的任务为:</strong></td>";
									if($row2['task']==5)
										echo "<td align='center'>任务书</td>";
									else if($row2['task']==6)
										echo "<td align='center'>开题报告</td>";
									else if($row2['task']==7)
										echo "<td align='center'>文献综述</td>";
									else if($row2['task']==8)
										echo "<td align='center'>外文翻译</td>";
									else if($row2['task']==9)
										echo "<td align='center'>中期检查表</td>";
									else if($row2['task']==10)
										echo "<td align='center'>毕业论文第一版</td>";
									else if($row2['task']==11)
										echo "<td align='center'>毕业论文第二版</td>";
									else if($row2['task']==12)
										echo "<td align='center'>毕业论文第三版</td>";
									else if($row2['task']==13)
										echo "<td align='center'>其它</td>";
									echo "</tr>";
									echo "<tr><td align='center' colspan='2'>指导老师还没未审核,请耐心等候</td></tr>";
								}
							}
						}
						else{
							$sql1="select * from filedb where studentid='$studentid' and task='$taskid'";
							$result1=mysql_query($sql1);
							$result2=mysql_query($sql1);
							$rowp=@mysql_fetch_array($result2);
							if(empty($rowp)){
								echo "<tr><td align='center' colspan='2'>未上传文件！</td></tr>";
							}
							else{
								while($row1=@mysql_fetch_array($result1)) 
									$row2=$row1;
								if(@$row2['state']==1){
									echo "<tr><td align='center' colspan='2'>本次任务已通过</td></tr>";
									echo "<tr><td valign='top'><strong><center>指导老师评审意见:</center></strong></td><td height='100px' valign='top' width='400px'>".$row2["brief"]."</td>";
								}
								else if(@$row2["state"]==2){
									echo "<tr><td align='center' colspan='2'>本次任务不通过,请重新提交</td></tr>";
									echo "<tr><td valign='top'><strong><center>指导老师评审意见:</center></strong></td><td height='100px' valign='top' width='400px'>".$row2["brief"]."</td>";//find and printf brief
									$wordname=$row2["filename"];//file's name
									@unlink("uploads/".$wordname);//delete file
								}
								else if(@$row2["state"]==0)
									echo "<tr><td align='center' colspan='2'>本次任务指导老师还没未审核，请耐心等候</td></tr>";
							}
						}
						mysql_close($con);
					?>
				</table>
			</div>
		</div>
	</body>

</html>