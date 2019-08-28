<!DOCTYPE html>
<html>
<?php
    session_start();//开启会话
?>
<?php
    if(empty($_SESSION["tch"]["id"])){
		echo "<script>alert('请先登录');window.location.href=\"../denglu/login.php\";</script>";
		exit;
	}
?>
<?php
     $addtime=time();
     @$id=$_SESSION["tch"]["id"];
     include ("dbconfig.php");
     $con = mysql_connect(HOST,USER,PASS);//连接mysql
      mysql_select_db(DBNAME,$con);//连接数据库
      mysql_query("set names 'GB2312'") ;
      for ($i=1; $i < 14; $i++) { 
         $tktime="select * from timedb where taskid=$i"; 
         $q=mysql_query($tktime,$con);
         $w=mysql_fetch_array($q);
         if($w>1){
         if($addtime<$w['starttime'])
      {
        $base[$i]="未开始";
      }else if ($addtime>=$w['starttime']&&$addtime<=$w['endtime']) {
        $base[$i]="进行中";
      }else if ($addtime>$w['endtime']) {
          $base[$i]="已截止";
      }}
      else  {
          $base[$i]="未开始";
      }
      }
    
    if(empty($_GET["task"])){
	        $task=5;
    }else
        $task=$_GET["task"];
       
?>

	<!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>毕业生管理系统</title>
		<style type="text/css">
        body{
          background-color: #F3F3FA;
          font-family:"微软雅黑", "宋体";
        }
        .class{
            margin-top: -100px;
        }
        .b{
            border:solid 1px #000000;
        }
		table{
			width:70%;
		}
        </style>
	</head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link type="text/css" href="css/index.css" rel="stylesheet" />
	<script type="text/javascript" src="js/index.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
	<body>
		<div style="background-color: #F0F0F0;height: 90px;">
			<img src="img/jhlogo.jpg" />
			<ul class="nav nav-tabs" style="width: 20%;float: right;margin-top: 49px;">
				<li><a href="../denglu/update.php">修改密码</a></li>
				<li><a href="../denglu/cleansession.php">退出系统</a></li>
			</ul>
		</div>
        <div>
			<div style="width: 18%;float:left;">
			<ul class="nav nav-tabs nav-stacked">
				<li onmouseover="Seover(this)" onmouseout="Seout(this)"><a href="##">毕业设计选题<span class="caret"></span></a>
				    <ul class="nav nav-tabs nav-stacked">
						<li><a href="sjpd.php?taskid=1">选题申报（<?php echo"$base[1]"?>）</a></li>
						<li><a href="lsck.php">查看选题</a></li>
						<li><a href="sjpd.php?taskid=3">第一轮筛选（<?php echo"$base[3]"?>）</a></li>
						<li><a href="sjpd.php?taskid=4">第二轮筛选（<?php echo"$base[4]"?>）</a></li>	
					</ul>
				</li>
				<li onmouseover="Seover(this)" onmouseout="Seout(this)"><a href="##">选择任务环节<span class="caret"></span></a>
					<ul class="nav nav-tabs nav-stacked">
						<li><a href="Index_ht.php?task=5">任务书（<?php echo"$base[5]"?>）</a></li>
						<li><a href="Index_ht.php?task=6">开题报告（<?php echo"$base[6]"?>）</a></li>
						<li><a href="Index_ht.php?task=7">文献综述（<?php echo"$base[7]"?>）</a></li>
						<li><a href="Index_ht.php?task=8">外文翻译（<?php echo"$base[8]"?>）</a></li>
						<li><a href="Index_ht.php?task=9">中期检查表（<?php echo"$base[9]"?>）</a></li>
						<li><a href="Index_ht.php?task=10">毕业论文一改（<?php echo"$base[10]"?>）</a></li>
						<li><a href="Index_ht.php?task=11">毕业论文二改（<?php echo"$base[11]"?>）</a></li>
						<li><a href="Index_ht.php?task=12">毕业论文三改（<?php echo"$base[12]"?>）</a></li>
						<li><a href="Index_ht.php?task=13">其他（<?php echo"$base[13]"?>）</a></li>
					</ul>
				</li>
				<li><a href="tzl.php">选题总览</a></li>
				<li><a href="tjzl.php">文档提交情况</a></li>
			</ul>
			</div>
				<div style="width: 82%;float:right;">
								<div name="ckxt">
								<center>
							<?php
								@$pid=$_POST['pid'];
								if(empty($pid)){
									echo "<script>alert('非法跳转');history.go(-1);</script>";
									exit;
								}
								$sql=mysql_query("select * from ttable,teacherdb where ttable.pid=$pid and ttable.tid=teacherdb.Id");
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
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>

</html>