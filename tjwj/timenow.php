<?php
    session_start();//�����Ự
	header("Content-Type: text/html;charset=gb2312");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>��ҵ������ϵͳ</title>
	</head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link type="text/css" href="css/index.css" rel="stylesheet" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script src="laydate/laydate.js"></script>
	<body>
		<div style="background-color: #F0F0F0;height: 90px;">
			<img src="img/jhlogo.jpg" />
			<ul class="nav nav-tabs" style="width: 20%;float: right;margin-top: 49px;background-color: #F0F0F0;">
				<li><a href="../denglu/update.php">�޸�����</a></li>
				<li><a href="../denglu/cleansession.php">�˳�ϵͳ</a></li>
			</ul>
		</div>
        <div>
			<div style="width: 18%;float:left;">
				<ul class="nav nav-tabs nav-stacked">
					<li><a href="insertime.html">����ʱ��</a></li>
					<li><a href="timenow.php">�鿴ʱ��</a></li>
					<li><a href="xtzl.php">ѡ������</a></li>
					<li><a href="fpxs.php">����ѡ��ѧ��</a></li>
				</ul>
			</div>
			<div style="width: 82%;float:right;">
				<table class="table table-striped table-bordered table-hover" style="width:60%; margin-top: 20px;margin-left: 10%;">
            	<?php
					if(empty($_SESSION["gly"]["id"]))
						echo "<script>alert('���ȵ�¼');window.location.href=\"../denglu/login.php\";</script>";
					else{
						include ("dbconfig.php");
						$con=mysql_connect(HOST,USER,PASS);//�������ݿ�
						mysql_select_db(DBNAME,$con);//ѡ�����ݿ�
						mysql_query("set names 'gb2312'");
						$sql="select * from timedb";
						$result=mysql_query($sql);

						echo "<tr>
						<th>&nbsp;</th>
						<th>��ʼʱ��</th>
						<th>��ֹʱ��</th>
						</tr>";
						while($row=@mysql_fetch_array($result)){
							echo "<tr>";
							if($row["taskid"]==1)
								$task="ѡ���걨";
							else if($row["taskid"]==2)
								$task="ѧ��ѡ��";
							else if($row["taskid"]==3)
								$task="��һ��ɸѡ";
							else if($row["taskid"]==4)
								$task="�ڶ���ɸѡ";
							else if($row["taskid"]==5)
								$task="������";
							else if($row["taskid"]==6)
								$task="���ⱨ��";
							else if($row["taskid"]==7)
								$task="��������";
							else if($row["taskid"]==8)
								$task="���ķ���";
							else if($row["taskid"]==9)
								$task="���ڼ���";
							else if($row["taskid"]==10)
								$task="��ҵ���ĵ�һ��";
							else if($row["taskid"]==11)
								$task="��ҵ���ĵڶ���";
							else if($row["taskid"]==12)
								$task="��ҵ���ĵ�����";
							else if($row["taskid"]==13)
								$task="����";
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