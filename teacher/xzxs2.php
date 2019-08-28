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
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
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
			<center><h3>第二轮筛选</h3></center>
			<?php
				$con = mysql_connect(HOST,USER,PASS);//连接mysql
				mysql_select_db(DBNAME,$con);//连接数据库
				mysql_query("set names 'GB2312'") ;
				$tc="select * from ttable where tid=$id";
				$tq=mysql_query($tc,$con);
				$num=1;
				while($tw=mysql_fetch_array($tq)){
					echo "
					<button onClick='show(".$tw['pid'].")' data-trigger='hover' class='btn btn-default dropdown-toggle' title=".$tw['ptitle']."  
				data-container='body' data-toggle='popover' data-placement='top' 
				data-content='最高上限人数:".$tw['ppnum']."' name='pid'  type='submit' style='width:300px;margin-top:20px;margin-left:50px;'>题目$num</button>
				<!--/form-->
							";
					
				$num++;
				}
			?>
				<div style="padding-top:20px;">
					<font id="numfont" style="font-size:16px;margin-left:60px;padding-top:20px;"></font>
					<div style="margin-left:60px;margin-top:20px;font-size:16px;width:50%;overflow-y:scroll;height:10px;" id="scrolldiv">
						<form action="bbb.php" method="post" id="inloginDiv">
						</form>
					</div>
				</div>
			</div>
		</div>
		
		<script>
			var c=0;
			function check(obj) { 
				var limit=document.getElementById('maxnum').value;
				obj.checked?c++:c--; 
				if(c>limit){ 
					obj.checked=false; 
					alert("选择人数不能超过"+limit+"个人"); 
					c--; 
				} 
			} 
		
			$(function () { 
				$("[data-toggle='popover']").popover();
			});		
			var show=function(id){
				$.ajax({
					type:"GET",
					url:"xzxs2_action.php", 
					data:{id:id},
					dataType:'json',
					success:updatepid
				});
				c=0;
			}
			function checkup(){
				  if(window.confirm("确定要提交吗？"))
				  {
				   return true;
				  }
				  else
				  {
					return false;
				  }
			}
			function updatepid(json){
				var i;
				var str="";
				$('#numfont').html(str);
				$('#inloginDiv').html(str);
				document.getElementById('scrolldiv').style.height="10px";
				if(json[1]["peoplenum"]==0&&json[1]["num"]!=0){
					str+="当前还可以选择:";
					str+=json[1]["num"];
					str+="个人，但是没有可选学生<br />";
					$('#numfont').html(str);
				}
				if(json[1]["num"]==0){
					str+="人数已达上限<br />";
					$('#numfont').html(str);
				}
				else if(json[1]["peoplenum"]!=0&&json[1]["num"]!=0){
					str+="当前还可以选择:";
					str+=json[1]["num"];
					str+="<input type='hidden' name='maxnum' id='maxnum' value="+json[1]['num']+" />";
					str+="个人";
					$('#numfont').html(str);
					str="<table class='table table-striped table-bordered table-hover' style='width: 100%;margin-top: 20px;'>";
					str+="<tr>";
					str+="<td><strong>学号</strong></td>";
					str+="<td><strong>姓名</strong></td>";
					str+="<td><strong>选择</strong></td>";
					str+="</tr>";
					for(i=1;i<=json[1]["num"];i++){	
						str+="<tr>";
						str+="<td>";
						str+="<input type='hidden' name='pid' value="+json[1]["pid"]+" />";
						str+=json[i]["sidnot"];
						str+="</td>";
						str+="<td>";
						str+=json[i]["Namenot"];
						str+="</td>";
						str+="<td>";
						str+="<input type='checkbox' name='checkbox[]'  onclick='check(this)' value="+json[i]["sidnot"]+" />";
						str+="</td>";
						str+="</tr>";
					}
					str+="<tr>";
					str+="<td colspan='3'>";
					str+="<input class='btn btn-default' type='submit' value='提交' onclick='return checkup()' style='width:40%' />";
					str+="</td>"
					str+="</tr>";
					str+="</table>";
					document.getElementById('scrolldiv').style.height="200px";
					$('#inloginDiv').html(str);
				}
				
				/*
				if(json[1]["snum"]!=0){
					str+="当前已选择的学生:<br />";
						for(i=1;i<=json[1]["yesi"];i++){
							str+=json[i]["Nameyes"];
							str+="(";
							str+=json[i]["sidyes"];
							str+=")&nbsp;&nbsp;&nbsp;";
						}
				}
				*/
	
			}
		</script>
	</body>
</html>