<!DOCTYPE html>
<html>
<?php
    session_start();//开启会话
	header("Contect-Type:text/html;charsrt=gb2312");
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
	  
    @$id=$_GET["id"];
    @$tid=$_SESSION["tch"]["id"];
    @$task=$_GET["task"];
    @$state=$_GET["state"];
	if($state!=0){
		echo "<script>alert('非法跳转!');window.location.href=\"Index_ht.php?task=$task\";</script>";
		exit;
	}
	$stg="select name from studentdb where Id={$id}";
	$stgr=mysql_query($stg);
	$stgrow=@mysql_fetch_array($stgr);
        $sql_select="select * from filedb where studentid={$id} and task={$task} and state={$state}";
        $res_select=mysql_query($sql_select,$con);
        $row= @mysql_fetch_array($res_select);
		if(!$row){
			echo "<script>alert('没有找到要查看的信息!');window.location.href=\"Index_ht.php?task=$task\";</script>";
			exit;
		}
        mysql_close($con); 
        ?>
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
			text-align:center;
		}
        </style>
	</head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link type="text/css" href="css/index.css" rel="stylesheet" />
	<script type="text/javascript" src="js/index.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
	    <script language="javascript">
function checkup()
{
  if(window.confirm("确定要提交吗？"))
  {
   return true;
  }
  else
  {
    return false;
  }
}
</script>

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
				<center>
       <table  class="table table-striped table-bordered table-hover" style="width:70%;margin-top:20px;">
        <center>
    <form action="teacherupdate.php" method="post">
    <input type="hidden" value="<?php echo $task; ?>" name="task">
	<input type="hidden" value="<?php echo $row['studentid']; ?>" name="id">
    <table class="table table-striped table-bordered table-hover" style="width: 70%;margin-top: 15px;">
	<tbody>
     <tr>
        <td align="center">学号</td>
       <td><?php echo  $row['studentid'];?></td>
    </tr>
    <tr>
        <td align="center">姓名</td>
        <td><?php echo $stgrow[0];?></td>
    </tr>
    <tr>
        <td align="center">课题名称:</td>
        <td> <?php echo $row['filename'];?></td>
    </tr>
    <tr>
        <td align="center">任务次数:</td>
        <td>
		<?php
		if($task==5)
		   echo "任务书";
		else if ($task==6) 
		   echo "开题报告";
		else if ($task==7)
		   echo "文献综述";
		else if ($task==8)
		   echo "外文翻译";
		else if ($task==9)
		   echo "中期检查表";
		else if ($task==10)
		   echo "毕业论文一改";
		else if ($task==11)
		   echo "毕业论文二改";
		else if ($task==12)
		   echo "毕业论文三改";
		else if ($task==13)
		   echo "其他";
	?>
 </td>
    </tr>
    <tr>
        <td align="center">审核状态:</td>
        <td><input type="radio" value="1" name="state" onclick="if(this.c==1){this.c=0;this.checked=0;}else{this.c=1;}" c="0">&nbsp;通过
        <input type="radio" value="2" name="state" onclick="if(this.cc==1){this.cc=0;this.checked=0;}else{this.cc=1;}" cc="0">&nbsp;不通过</td>
    </tr>
    <tr>
        <td align="center" valign="top">评价</td>
        <td><textarea cols="25" rows="5" class="form-control" name="brief" ><?php echo $row['brief'];?></textarea></td>
    </tr>
    <tr>
        <td colspan="2" align="center">
        <input type="Submit" id="button" value="提交" class="btn btn-primary" onclick="return checkup()" style="width:150px;"/>
        
    </td>
    </tr>
	</tbody>
    </table>   
    </form>
    </center>
	</div>
	</body>
</html>