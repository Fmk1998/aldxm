<?php
    session_start();//�����Ự
	@header("Content-type: text/html; charset=gb2312"); 
?>
<?php
	include ("dbconfig.php");
	$con = mysql_connect(HOST,USER,PSW);
	mysql_select_db(dbname,$con);
	mysql_query("set names 'GB2312'");
	@$studentid=$_SESSION["login"]["id"];//get studentid
	if(empty($studentid)){
		echo "<script>alert('���ȵ�¼');window.location.href=\"../denglu/login.php\";</script>";
		exit;
	}
	$taskid=@$_GET["taskid"];
?>
<!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>��ҵ������ϵͳ</title>
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
					str="(�ѽ�ֹ)";
				else if(json[2]==1)
					str="(������)";
				else if(json[2]==2)
					str="(δ��ʼ)";
				$('#j').html(str);
				for(var i=5;i<14;i++){
					if(json[i]==0)
					  str="(�ѽ�ֹ)";
					else if(json[i]==1)
						str="(������)";
					else if(json[i]==2)
						str="(δ��ʼ)";
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
						<h1 style="margin-left: 400px;">ָ����ʦ����</h1>
					</td>
				</tr>
			</table>
			<ul class="nav nav-tabs" style="width: 20%;float: right;margin-top:-32px;">
				<li><a href="../denglu/update.php">�޸�����</a></li>
				<li><a href="../denglu/cleansession.php">�˳�ϵͳ</a></li>
		</div>
		<div>
			<div style="width: 18%;float:left;">
				<ul class="nav nav-tabs nav-stacked">
					<li onmouseover="Seover(this)" onmouseout="Seout(this)"><a>��ҵ���ѡ��<span class="caret"></span></a>
						<ul class="nav nav-tabs nav-stacked">
							<li><a href="xtck.php">�鿴ѡ��</a></li>
							<li><a href="../tjwj/sjpd.php?taskid=2">�ѡ��־Ը<font id="j"></font></a></li>
						</ul>
					</li>
					<li onmouseover="Seover(this)" onmouseout="Seout(this)"><a>ѡ�����񻷽�<span class="caret"></span></a>
						<ul class="nav nav-tabs nav-stacked">
							<li><a href="../tjwj/sjpd.php?taskid=5">������<font id="a"></font></a></li>
							<li><a href="../tjwj/sjpd.php?taskid=6">���ⱨ��<font id="b"></font></a></li>
							<li><a href="../tjwj/sjpd.php?taskid=7">��������<font id="c"></font></a></li>
							<li><a href="../tjwj/sjpd.php?taskid=8">���ķ���<font id="d"></font></a></li>
							<li><a href="../tjwj/sjpd.php?taskid=9">���ڼ���<font id="e"></font></a></li>
							<li><a href="../tjwj/sjpd.php?taskid=10">��ҵ���ĵ�һ��<font id="f"></font></a></li>
							<li><a href="../tjwj/sjpd.php?taskid=11">��ҵ���ĵڶ���<font id="g"></font></a></li>
							<li><a href="../tjwj/sjpd.php?taskid=12">��ҵ���ĵ�����<font id="h"></font></a></li>
							<li><a href="../tjwj/sjpd.php?taskid=13">����<font id="i"></font></a></li>
						</ul>
					</li>
					<li onmouseover="Seover(this)" onmouseout="Seout(this)"><a>����ѡ��<span class="caret"></span></a>
						<ul class="nav nav-tabs nav-stacked">
							<li><a href="mbxz.html">ģ������</a></li>
						</ul>
					</li>
					<li onmouseover="Seover(this)" onmouseout="Seout(this)"><a>�鿴���<span class="caret"></span></a>
						<ul class="nav nav-tabs nav-stacked">
							<li><a href="result.php">�鿴ѡ����</a></li>
							<li><a href="teacherbrief.php">ָ����ʦ����</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<div style="width: 78%;float:right;padding-top:25px;">
				<table class='table table-striped table-bordered table-hover' style='width: 60%;margin-top: 15px;'>
					<tr>
						<td align="center"><strong>��ѡ������:</strong></td>
						<td align="center">
							<select name="taskid" id="testSelect" onchange="getselect()">
								<option>------</option>
								<option value="5">������</option>
								<option value="6">���ⱨ��</option>
								<option value="7">��������</option>
								<option value="8">���ķ���</option>
								<option value="9">���ڼ���</option>
								<option value="10">��ҵ���ĵ�һ��</option>
								<option value="11">��ҵ���ĵڶ���</option>
								<option value="12">��ҵ���ĵ�����</option>
								<option value="13">����</option>
							</select>
						</td>
					</tr>
					<tr>
						<?php
							if(!empty($taskid))
								echo "<td align='center'><strong>��ǰ�鿴������Ϊ:</strong></td>";
							if($taskid==5)
								echo "<td align='center'>������</td>";
							else if($taskid==6)
								echo "<td align='center'>���ⱨ��</td>";
							else if($taskid==7)
								echo "<td align='center'>��������</td>";
							else if($taskid==8)
								echo "<td align='center'>���ķ���</td>";
							else if($taskid==9)
								echo "<td align='center'>���ڼ���</td>";
							else if($taskid==10)
								echo "<td align='center'>��ҵ���ĵ�һ��</td>";
							else if($taskid==11)
								echo "<td align='center'>��ҵ���ĵڶ���</td>";
							else if($taskid==12)
								echo "<td align='center'>��ҵ���ĵ�����</td>";
							else if($taskid==13)
								echo "<td align='center'>����</td>";
						?>
					</tr>
					<?php
						if(empty($taskid)){
							$sql1="select * from filedb where studentid='$studentid'";
							$result1=mysql_query($sql1);
							$result2=mysql_query($sql1);
							$rowp=@mysql_fetch_array($result2);
							if(empty($rowp)){
								echo "<tr><td align='center' colspan='2'>δ�ϴ��ļ���</td></tr>";
							}
							else{
								while($row1=@mysql_fetch_array($result1)) 
									$row2=$row1;
								if(@$row2['state']==1){
									if($row2['task']==5)
										echo "<tr><td align='center' colspan='2'>������������ͨ��</td></tr>";
									else if($row2['task']==6)
										echo "<tr><td align='center' colspan='2'>���ⱨ��������ͨ��</td></tr>";
									else if($row2['task']==7)
										echo "<tr><td align='center' colspan='2'>��������������ͨ��</td></tr>";
									else if($row2['task']==8)
										echo "<tr><td align='center' colspan='2'>���ķ���������ͨ��</td></tr>";
									else if($row2['task']==9)
										echo "<tr><td align='center' colspan='2'>���ڼ���������ͨ��</td></tr>";
									else if($row2['task']==10)
										echo "<tr><td align='center' colspan='2'>��ҵ���ĵ�һ��������ͨ��</td></tr>";
									else if($row2['task']==11)
										echo "<tr><td align='center' colspan='2'>��ҵ���ĵڶ���������ͨ��</td></tr>";
									else if($row2['task']==12)
										echo "<tr><td align='center' colspan='2'>��ҵ���ĵ�����������ͨ��</td></tr>";
									else if($row2['task']==13)
										echo "<tr><td align='center' colspan='2'>����������ͨ��</td></tr>";
									echo "<tr><td valign='top'><strong><center>ָ����ʦ�������:</center></strong></td><td height='100px' valign='top' width='400px'>".$row2["brief"]."</td>";
								}
								else if(@$row2["state"]==2){
									if($row2['task']==5)
										echo "<tr><td align='center' colspan='2'>����������δͨ��</td></tr>";
									else if($row2['task']==6)
										echo "<tr><td align='center' colspan='2'>���ⱨ������δͨ��</td></tr>";
									else if($row2['task']==7)
										echo "<tr><td align='center' colspan='2'>������������δͨ��</td></tr>";
									else if($row2['task']==8)
										echo "<tr><td align='center' colspan='2'>���ķ�������δͨ��</td></tr>";
									else if($row2['task']==9)
										echo "<tr><td align='center' colspan='2'>���ڼ�������δͨ��</td></tr>";
									else if($row2['task']==10)
										echo "<tr><td align='center' colspan='2'>��ҵ���ĵ�һ������δͨ��</td></tr>";
									else if($row2['task']==11)
										echo "<tr><td align='center' colspan='2'>��ҵ���ĵڶ�������δͨ��</td></tr>";
									else if($row2['task']==12)
										echo "<tr><td align='center' colspan='2'>��ҵ���ĵ���������δͨ��</td></tr>";
									else if($row2['task']==13)
										echo "<tr><td align='center' colspan='2'>��������δͨ��</td></tr>";
									echo "<tr><td valign='top'><strong><center>ָ����ʦ�������:</center></strong></td><td height='100px' valign='top' width='400px'>".$row2["brief"]."</td>";//find and printf brief
									$wordname=$row2["filename"];//file's name
									@unlink("uploads/".$wordname);//delete file
								}
								else if(@$row2["state"]==0){
									echo "<tr>";
									echo "<td align='center'><strong>��ǰ�鿴������Ϊ:</strong></td>";
									if($row2['task']==5)
										echo "<td align='center'>������</td>";
									else if($row2['task']==6)
										echo "<td align='center'>���ⱨ��</td>";
									else if($row2['task']==7)
										echo "<td align='center'>��������</td>";
									else if($row2['task']==8)
										echo "<td align='center'>���ķ���</td>";
									else if($row2['task']==9)
										echo "<td align='center'>���ڼ���</td>";
									else if($row2['task']==10)
										echo "<td align='center'>��ҵ���ĵ�һ��</td>";
									else if($row2['task']==11)
										echo "<td align='center'>��ҵ���ĵڶ���</td>";
									else if($row2['task']==12)
										echo "<td align='center'>��ҵ���ĵ�����</td>";
									else if($row2['task']==13)
										echo "<td align='center'>����</td>";
									echo "</tr>";
									echo "<tr><td align='center' colspan='2'>ָ����ʦ��ûδ���,�����ĵȺ�</td></tr>";
								}
							}
						}
						else{
							$sql1="select * from filedb where studentid='$studentid' and task='$taskid'";
							$result1=mysql_query($sql1);
							$result2=mysql_query($sql1);
							$rowp=@mysql_fetch_array($result2);
							if(empty($rowp)){
								echo "<tr><td align='center' colspan='2'>δ�ϴ��ļ���</td></tr>";
							}
							else{
								while($row1=@mysql_fetch_array($result1)) 
									$row2=$row1;
								if(@$row2['state']==1){
									echo "<tr><td align='center' colspan='2'>����������ͨ��</td></tr>";
									echo "<tr><td valign='top'><strong><center>ָ����ʦ�������:</center></strong></td><td height='100px' valign='top' width='400px'>".$row2["brief"]."</td>";
								}
								else if(@$row2["state"]==2){
									echo "<tr><td align='center' colspan='2'>��������ͨ��,�������ύ</td></tr>";
									echo "<tr><td valign='top'><strong><center>ָ����ʦ�������:</center></strong></td><td height='100px' valign='top' width='400px'>".$row2["brief"]."</td>";//find and printf brief
									$wordname=$row2["filename"];//file's name
									@unlink("uploads/".$wordname);//delete file
								}
								else if(@$row2["state"]==0)
									echo "<tr><td align='center' colspan='2'>��������ָ����ʦ��ûδ��ˣ������ĵȺ�</td></tr>";
							}
						}
						mysql_close($con);
					?>
				</table>
			</div>
		</div>
	</body>

</html>