<?php
	header("Content-Type: text/html;charset=gb2312");
    session_start();//开启会话
	include("dbconfig.php");
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
						<h1 style="margin-left: 400px;">查看选题</h1>
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
					   <td style='width:150px;'><strong>姓名</strong></td>
						   <td align='center'><?php echo $row['Name'];?></td>
					 </tr>
					 <tr>
					   <td><strong>课题名称</strong></td>
						<td align='center'><?php echo $row['ptitle'];?></td>
					 </tr>
					 <tr>
					   <td><strong>课题类型</strong></td>
					   <td align='center'><?php echo $row["ptype"];?></td>
					 </tr>
					 <tr>
					   <td><strong>课题性质</strong></td>
					   <td align='center'><?php echo $row["pcha"];?></td>
					 </tr>
					 <tr>
					   <td><strong>课题来源</strong></td>
					   <td align='center'><?php echo $row["psource"];?></td>
					 </tr>
					 <tr>
					   <td><strong>课题学生组人数</strong></td>
					   <td align='center'><?php echo $row["ppnum"];?></td>
					 </tr>
					 <tr>
					   <td><strong>主要研究内容及成果形式</strong></td>
					   <td height='100px' valign='top' width='400px'><?php echo $row["pcontent"];?></td>
					 </tr>
					 <tr> 
					   <td><strong>难度份量综合训练情况</strong></td>
					   <td height='100px' valign='top' width='400px'><?php echo $row["plevel"];?></td>
					 </tr>
					 <tr>
					   <td><strong>工作条件和措施</strong></td>
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