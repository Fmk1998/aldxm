<?php
	header("Content-Type:text/html;charset=GB2312");
	session_start();
	include("dbconfig.php");
	@$studentid=$_SESSION["login"]["id"];//get studentid
	if(empty($studentid)){
		echo "<script>alert('���ȵ�¼');window.location.href=\"../denglu/login.php\";</script>";
		exit;
	}
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
		</script>
	<body onload="timeset()">
		<div style="background-color: #F0F0F0;height: 90px;">
			<table>
				<tr>
					<td>
						<img src="img/jhlogo.jpg"/>
					</td>
					<td valign="middle">
						<h1 style="margin-left: 400px;">�鿴ѡ����</h1>
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
			<div style="width: 75%;float:right;">
			<?php 
				$con = mysql_connect(HOST,USER,PSW);
				mysql_select_db(dbname,$con);
				mysql_query("set names 'GB2312'");
				$psql = "select * from ptable where sid='".$studentid."'";	//��ѯ��Ŀ����־Ը
				$presult = mysql_query($psql,$con);
				$prow =@mysql_fetch_array($presult);
				if(!empty($prow["pfid"])){
					$pfid=$prow['pfid'];
					$tsql = "select * from ttable where pid='".$pfid."'";	//��ѯ��ʦ�����Ϣ
					$tresult = mysql_query($tsql,$con);
					while($trow = @mysql_fetch_array($tresult)){
						$tid=$trow['tid'];
						$teasql = "select Name from teacherdb where Id='".$tid."'";	//��ѯ��ʦ��
						$tearesult = mysql_query($teasql,$con);
						$tearow = @mysql_fetch_array($tearesult);
						echo "<table class='table table-striped table-bordered table-hover' style='width: 60%;margin-top: 15px;'>";
						echo "<tr>";
						echo "<td colspan='2' align='center'><strong>ѡ����</strong></td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td><strong>��ʦ��</strong></td>";
						echo "<td>{$tearow['Name']}</td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td><strong>������</strong></td>";
						echo "<td>{$trow['ptitle']}</td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td><strong>��������</strong></td>";
						echo "<td>{$trow['ptype']}</td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td><strong>��������</strong></td>";
						echo "<td>{$trow['pcha']}</td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td><strong>������Դ</strong></td>";
						echo "<td>{$trow['psource']}</td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td valign='top'><strong>��Ҫ�о�����</strong></td>";
						echo "<td height='100px' valign='top' width='400px'>{$trow['pcontent']}</td>";
						echo "</tr>";
						echo "</table>";
					}
				}else{
					if(empty($prow))
						echo "<div class=\"alert alert-warning\" style=\"width:80%;margin-top:30px;font-size:24px;\">����û���־Ը��</div>";
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
						echo "<td colspan='4' align='center'><strong>�㻹û��ѡ��</strong></td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td align=\"center\" style='width:17%;'><strong></strong></td>";
						echo "<td align=\"center\" style='width:49%;'><strong>��Ŀ</strong></td>";
						echo "<td align=\"center\" style='width:17%;'><strong>��ʦ����</strong></td>";
						echo "<td align=\"center\" style='width:17%;'><strong>������Ϣ</strong></td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td align=\"center\"><strong>��һ־Ը</strong></td>";
						echo "<td align=\"center\"><strong>".$sqlpid1row["ptitle"]."</strong></td>";
						echo "<td align=\"center\"><strong>".$sqlpid1row["Name"]."</strong></td>";
						echo "<form method='POST' action='ckxt.php'>";
						echo "<input type='hidden' value=".$pid1." name='pid'>";
						echo "<td align=\"center\" style='padding: 5px 0;'>";
						echo "<input type='submit' value='�鿴' class=\"btn btn-primary\" style='margin:0;'>";
						echo "</td>";
						echo "</form>";
						echo "</tr>";
						echo "<tr>";
						echo "<td align=\"center\"><strong>�ڶ�־Ը</strong></td>";
						echo "<td align=\"center\"><strong>".$sqlpid2row["ptitle"]."</strong></td>";
						echo "<td align=\"center\"><strong>".$sqlpid2row["Name"]."</strong></td>";
						echo "<form method='POST' action='ckxt.php'>";
						echo "<input type='hidden' value=".$pid2." name='pid'>";
						echo "<td align=\"center\" style='padding: 5px 0;'>";
						echo "<input type='submit' value='�鿴' class=\"btn btn-primary\" style='margin:0;'>";
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