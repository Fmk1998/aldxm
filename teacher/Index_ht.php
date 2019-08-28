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
			text-align:center;
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
				<center>
        <table  class="table table-striped table-bordered table-hover" style="width:70%;margin-top:20px;">
			<tr>
				<td colspan="6" style="color:green">
					<?php 
					if($task==5)
					   echo "任务书";
				   elseif ($task==6)
					   echo "开题报告";
					elseif ($task==7)
					   echo "文献综述";
					elseif ($task==8)
					   echo "外文翻译";
					elseif ($task==9)
					   echo "中期检查表";
					elseif ($task==10)
					   echo "毕业论文一改";
					   elseif ($task==10)
					   echo "毕业论文一改";
					elseif ($task==11)
					   echo "毕业论文二改";
					elseif ($task==12)
					   echo "毕业论文三改";
					elseif ($task==13)
					   echo "其他";		
					
					
					?>提交情况
				</td>
			</tr>
            <tr style="background-color: #F3F3FA;" >
				<td>&nbsp;</td>
                <td align="center">学号</td>
                <td align="center">姓名</td>
                <td align="center">文件名</td>
                <td align="center">任务环节</td>             
                <td align="center">操作</td>
            </tr>
            <?php             
               $a="select * from informationdb where teacherid=$id";
               $b=@mysql_query($a,$con) ; 
              while($c = @mysql_fetch_assoc($b)){
                $studentid=$c['studentid'];
                $stg="select name from studentdb where Id={$studentid}";
				$stgr=mysql_query($stg);
				$stgrow=@mysql_fetch_array($stgr);
			    $q_1="select * from filedb where studentid={$studentid} and task={$task} and state=1";
                $w_1=mysql_query($q_1,$con);
                $row_1= @mysql_fetch_array($w_1);             
               if($row_1){
               echo "<tr>";
               echo "<td align='center'>审核通过</td>";
               echo "<td align='center'>".$row_1['studentid']." </td>"; 
               echo "<td align='center'>".$stgrow[0]." </td>"; 
                     echo "<td align='center'><a href='../student/uploads/{$row_1['filename']}'>".$row_1['filename']."</a> </td>";   
                    //echo "<td align='center'>".$row_1['task']." </td>";
					if($row_1['task']==5)
						echo "<td align='center'>任务书</td>";
					elseif ($row_1['task']==6)
						echo "<td align='center'>开题报告</td>";
					elseif ($row_1['task']==7)
						echo "<td align='center'>文献综述</td>";
					elseif ($row_1['task']==8)
						echo "<td align='center'>外文翻译</td>";
					elseif ($row_1['task']==9) 
						echo "<td align='center'>中期检查表</td>";
					elseif ($row_1['task']==10) 
						echo "<td align='center'>毕业论文一改</td>";
					elseif ($row_1['task']==11)
						echo "<td align='center'>毕业论文二改</td>";
					elseif ($row_1['task']==12)
						echo "<td align='center'>毕业论文三改</td>";
					elseif ($row_1['task']==13)
						echo "<td align='center'>其他</td>";				
                    echo "<td align='center'><a href='teachercheck.php?id={$row_1['studentid']}&task=$task&state={$row_1['state']}'>查看</a></td>";
                    echo "</tr>";
              
               }else{
               $q="select * from filedb where studentid={$studentid} and task={$task}";
               $w=mysql_query($q,$con);
              
			   while($row = mysql_fetch_assoc($w))
               {    echo "<tr>";
					if($row['state']==2)
                        echo "<td align='center'>审核未通过</td>"; 
					else
                        echo "<td align='center'>审核中</td>"; 
                    
                    echo "<td align='center'>".$row['studentid']." </td>";
					echo "<td align='center'>".$stgrow[0]." </td>"; 
                    echo "<td align='center'><a href='../student/uploads/{$row['filename']}'>".$row['filename']."</a> </td>";   
                    if($row['task']==5)
						echo "<td align='center'>任务书</td>";
					elseif ($row['task']==6)
						echo "<td align='center'>开题报告</td>";
					elseif ($row['task']==7)
						echo "<td align='center'>文献综述</td>";
					elseif ($row['task']==8)
						echo "<td align='center'>外文翻译</td>";
					elseif ($row['task']==9) 
						echo "<td align='center'>中期检查表</td>";
					elseif ($row['task']==10) 
						echo "<td align='center'>毕业论文一改</td>";
					elseif ($row['task']==11)
						echo "<td align='center'>毕业论文二改</td>";
					elseif ($row['task']==12)
						echo "<td align='center'>毕业论文三改</td>";
					elseif ($row['task']==13)
						echo "<td align='center'>其他</td>"; 
                    if($row['state']==0)
                  {
                    echo "<td align='center'><a href='teacher.php?id={$row['studentid']}&task=$task&state={$row['state']}'>审核</a></td>";
                  }
                  else{
                    echo "<td align='center'><a href='teachercheck.php?id={$row['studentid']}&task=$task&state={$row['state']}'>查看</a></td>";
                  }
                    echo "</tr>";
                }
            }
          }
					echo "</form>";
                ?> 
            </table>
       <table  class="table table-striped table-bordered table-hover" style="width:70%;margin-top:20px;">
	   <tr >
            
				<td colspan="2" style="color:red">未提交</td>
				</tr><tr>
                <td align="center">学号</td>
                <td align="center">姓名</td>              
            </tr>
                <?php
                
				$stid="select studentid from informationdb where teacherid=$id";
				$stidr=mysql_query($stid);
				while($stidrow=@mysql_fetch_assoc($stidr)){
					$u_1="select * from filedb where studentid={$stidrow['studentid']} and task=$task";
					$i_1=mysql_query($u_1);
					$row_3=@mysql_fetch_array($i_1);
					if(empty($row_3)){					
						$stn="select name from studentdb where Id={$stidrow['studentid']}";
						$stnr=mysql_query($stn);
						$stnrow=@mysql_fetch_array($stnr);
						echo "<tr>";
						//echo "<td align='center'>未提交</td>";
						echo "<td align='center'>".$stidrow['studentid']." </td>"; 
						echo "<td align='center'>".$stnrow[0]." </td>"; 
						echo "</tr>"; 
					}
				}             
               ?>
		</table>
		</center>
	</div>
	</body>
</html>