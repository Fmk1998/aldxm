<?php
	header("Content-Type: text/html;charset=gb2312");
    session_start();//�����Ự
	include("dbconfig.php");
	if(empty($_SESSION["login"]["id"])){
        echo "<script>alert('���ȵ�¼');window.location.href=\"../denglu/login.php\";</script>";
		exit;
	}
?>
<!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>��ҵ������ϵͳ</title>
		<style>
			table tr td{
				height:30px;
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
						<h1 style="margin-left: 400px;">�鿴ѡ��</h1>
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
			<div style="width: 82%;float:right;">
		<div name="ckxt">
			<center>
				<?php
					$con = mysql_connect(HOST,USER,PSW);
					mysql_select_db(dbname,$con);
					mysql_query("set names 'GB2312'");
					@$pid=$_POST['pid'];
					$sql=mysql_query("select Name,ptitle,ptype,pcha,psource,ppnum,pcontent,plevel,pcondition from ttable,teacherdb where ttable.pid=$pid and ttable.tid=teacherdb.Id");
					while(@$row=mysql_fetch_assoc($sql)){
				?>

				 <table class='table table-striped table-bordered table-hover' style='width: 70%;margin-top: 15px;'>
				   <tbody>
					 <tr>
					   <td style='width:150px;'><strong>����</strong></td>
						   <td align='center'><?php echo $row['Name'];?></td>
					 </tr>
					 <tr>
					   <td><strong>��������</strong></td>
						<td align='center'><?php echo $row['ptitle'];?></td>
					 </tr>
					 <tr>
					   <td><strong>��������</strong></td>
					   <td align='center'><?php echo $row["ptype"];?></td>
					 </tr>
					 <tr>
					   <td><strong>��������</strong></td>
					   <td align='center'><?php echo $row["pcha"];?></td>
					 </tr>
					 <tr>
					   <td><strong>������Դ</strong></td>
					   <td align='center'><?php echo $row["psource"];?></td>
					 </tr>
					 <tr>
					   <td><strong>����ѧ��������</strong></td>
					   <td align='center'><?php echo $row["ppnum"];?></td>
					 </tr>
					 <tr>
					   <td><strong>��Ҫ�о����ݼ��ɹ���ʽ</strong></td>
					   <td height='100px' valign='top' width='400px'><?php echo $row["pcontent"];?></td>
					 </tr>
					 <tr> 
					   <td><strong>�Ѷȷ����ۺ�ѵ�����</strong></td>
					   <td height='100px' valign='top' width='400px'><?php echo $row["plevel"];?></td>
					 </tr>
					 <tr>
					   <td><strong>���������ʹ�ʩ</strong></td>
					   <td height='100px' valign='top' width='400px'><?php echo $row["pcondition"];?></td>
					 </tr>
				   </tbody>
				 </table>
			
					<?php } ?>

		 </center>
		 </div>
		</div>
	</body>

</html>