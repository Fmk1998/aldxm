<!DOCTYPE html>
<html>
<?php
    session_start();//�����Ự
	header("Contect-Type:text/html;charsrt=gb2312");
?>
<?php
    if(empty($_SESSION["tch"]["id"])){
		echo "<script>alert('���ȵ�¼');window.location.href=\"../denglu/login.php\";</script>";
		exit;
	}
?>
<?php
     $addtime=time();
     @$id=$_SESSION["tch"]["id"];
     include ("dbconfig.php");
     $con = mysql_connect(HOST,USER,PASS);//����mysql
      mysql_select_db(DBNAME,$con);//�������ݿ�
      mysql_query("set names 'GB2312'") ;
	   for ($i=1; $i < 14; $i++) { 
         $tktime="select * from timedb where taskid=$i"; 
         $q=mysql_query($tktime,$con);
         $w=mysql_fetch_array($q);
         if($w>1){
         if($addtime<$w['starttime'])
      {
        $base[$i]="δ��ʼ";
      }else if ($addtime>=$w['starttime']&&$addtime<=$w['endtime']) {
        $base[$i]="������";
      }else if ($addtime>$w['endtime']) {
          $base[$i]="�ѽ�ֹ";
      }}
      else  {
          $base[$i]="δ��ʼ";
      }
      
	   }
       
?>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>��ҵ������ϵͳ</title>
		<style type="text/css">
        body{
          background-color: #F3F3FA;
          font-family:"΢���ź�", "����";
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
				<li><a href="../denglu/update.php">�޸�����</a></li>
				<li><a href="../denglu/cleansession.php">�˳�ϵͳ</a></li>
			</ul>
		</div>
        <div>
			<div style="width: 18%;float:left;">
			<ul class="nav nav-tabs nav-stacked">
				<li onmouseover="Seover(this)" onmouseout="Seout(this)"><a href="##">��ҵ���ѡ��<span class="caret"></span></a>
				    <ul class="nav nav-tabs nav-stacked">
						<li><a href="sjpd.php?taskid=1">ѡ���걨��<?php echo"$base[1]"?>��</a></li>
						<li><a href="lsck.php">�鿴ѡ��</a></li>
						<li><a href="sjpd.php?taskid=3">��һ��ɸѡ��<?php echo"$base[3]"?>��</a></li>
						<li><a href="sjpd.php?taskid=4">�ڶ���ɸѡ��<?php echo"$base[4]"?>��</a></li>	
					</ul>
				</li>
				<li onmouseover="Seover(this)" onmouseout="Seout(this)"><a href="##">ѡ�����񻷽�<span class="caret"></span></a>
					<ul class="nav nav-tabs nav-stacked">
						<li><a href="Index_ht.php?task=5">�����飨<?php echo"$base[5]"?>��</a></li>
						<li><a href="Index_ht.php?task=6">���ⱨ�棨<?php echo"$base[6]"?>��</a></li>
						<li><a href="Index_ht.php?task=7">����������<?php echo"$base[7]"?>��</a></li>
						<li><a href="Index_ht.php?task=8">���ķ��루<?php echo"$base[8]"?>��</a></li>
						<li><a href="Index_ht.php?task=9">���ڼ���<?php echo"$base[9]"?>��</a></li>
						<li><a href="Index_ht.php?task=10">��ҵ����һ�ģ�<?php echo"$base[10]"?>��</a></li>
						<li><a href="Index_ht.php?task=11">��ҵ���Ķ��ģ�<?php echo"$base[11]"?>��</a></li>
						<li><a href="Index_ht.php?task=12">��ҵ�������ģ�<?php echo"$base[12]"?>��</a></li>
						<li><a href="Index_ht.php?task=13">������<?php echo"$base[13]"?>��</a></li>
					</ul>
				</li>
				<li><a href="tzl.php">ѡ������</a></li>
				<li><a href="tjzl.php">�ĵ��ύ���</a></li>
			</ul>
			</div>
			<div style="width: 82%;float:right;">
			<center><h3>�ڶ���ɸѡ</h3></center>
			<?php
				$con = mysql_connect(HOST,USER,PASS);//����mysql
				mysql_select_db(DBNAME,$con);//�������ݿ�
				mysql_query("set names 'GB2312'") ;
				$tc="select * from ttable where tid=$id";
				$tq=mysql_query($tc,$con);
				$num=1;
				while($tw=mysql_fetch_array($tq)){
					echo "
					<button onClick='show(".$tw['pid'].")' data-trigger='hover' class='btn btn-default dropdown-toggle' title=".$tw['ptitle']."  
				data-container='body' data-toggle='popover' data-placement='top' 
				data-content='�����������:".$tw['ppnum']."' name='pid'  type='submit' style='width:300px;margin-top:20px;margin-left:50px;'>��Ŀ$num</button>
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
					alert("ѡ���������ܳ���"+limit+"����"); 
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
				  if(window.confirm("ȷ��Ҫ�ύ��"))
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
					str+="��ǰ������ѡ��:";
					str+=json[1]["num"];
					str+="���ˣ�����û�п�ѡѧ��<br />";
					$('#numfont').html(str);
				}
				if(json[1]["num"]==0){
					str+="�����Ѵ�����<br />";
					$('#numfont').html(str);
				}
				else if(json[1]["peoplenum"]!=0&&json[1]["num"]!=0){
					str+="��ǰ������ѡ��:";
					str+=json[1]["num"];
					str+="<input type='hidden' name='maxnum' id='maxnum' value="+json[1]['num']+" />";
					str+="����";
					$('#numfont').html(str);
					str="<table class='table table-striped table-bordered table-hover' style='width: 100%;margin-top: 20px;'>";
					str+="<tr>";
					str+="<td><strong>ѧ��</strong></td>";
					str+="<td><strong>����</strong></td>";
					str+="<td><strong>ѡ��</strong></td>";
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
					str+="<input class='btn btn-default' type='submit' value='�ύ' onclick='return checkup()' style='width:40%' />";
					str+="</td>"
					str+="</tr>";
					str+="</table>";
					document.getElementById('scrolldiv').style.height="200px";
					$('#inloginDiv').html(str);
				}
				
				/*
				if(json[1]["snum"]!=0){
					str+="��ǰ��ѡ���ѧ��:<br />";
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