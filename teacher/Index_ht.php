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
    
    if(empty($_GET["task"])){
	        $task=5;
    }else
        $task=$_GET["task"];
       
?>

	<!DOCTYPE html>
<html>

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
	<link rel="stylesheet" href="css/bootstrap.min.css">
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
				<center>
        <table  class="table table-striped table-bordered table-hover" style="width:70%;margin-top:20px;">
			<tr>
				<td colspan="6" style="color:green">
					<?php 
					if($task==5)
					   echo "������";
				   elseif ($task==6)
					   echo "���ⱨ��";
					elseif ($task==7)
					   echo "��������";
					elseif ($task==8)
					   echo "���ķ���";
					elseif ($task==9)
					   echo "���ڼ���";
					elseif ($task==10)
					   echo "��ҵ����һ��";
					   elseif ($task==10)
					   echo "��ҵ����һ��";
					elseif ($task==11)
					   echo "��ҵ���Ķ���";
					elseif ($task==12)
					   echo "��ҵ��������";
					elseif ($task==13)
					   echo "����";		
					
					
					?>�ύ���
				</td>
			</tr>
            <tr style="background-color: #F3F3FA;" >
				<td>&nbsp;</td>
                <td align="center">ѧ��</td>
                <td align="center">����</td>
                <td align="center">�ļ���</td>
                <td align="center">���񻷽�</td>             
                <td align="center">����</td>
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
               echo "<td align='center'>���ͨ��</td>";
               echo "<td align='center'>".$row_1['studentid']." </td>"; 
               echo "<td align='center'>".$stgrow[0]." </td>"; 
                     echo "<td align='center'><a href='../student/uploads/{$row_1['filename']}'>".$row_1['filename']."</a> </td>";   
                    //echo "<td align='center'>".$row_1['task']." </td>";
					if($row_1['task']==5)
						echo "<td align='center'>������</td>";
					elseif ($row_1['task']==6)
						echo "<td align='center'>���ⱨ��</td>";
					elseif ($row_1['task']==7)
						echo "<td align='center'>��������</td>";
					elseif ($row_1['task']==8)
						echo "<td align='center'>���ķ���</td>";
					elseif ($row_1['task']==9) 
						echo "<td align='center'>���ڼ���</td>";
					elseif ($row_1['task']==10) 
						echo "<td align='center'>��ҵ����һ��</td>";
					elseif ($row_1['task']==11)
						echo "<td align='center'>��ҵ���Ķ���</td>";
					elseif ($row_1['task']==12)
						echo "<td align='center'>��ҵ��������</td>";
					elseif ($row_1['task']==13)
						echo "<td align='center'>����</td>";				
                    echo "<td align='center'><a href='teachercheck.php?id={$row_1['studentid']}&task=$task&state={$row_1['state']}'>�鿴</a></td>";
                    echo "</tr>";
              
               }else{
               $q="select * from filedb where studentid={$studentid} and task={$task}";
               $w=mysql_query($q,$con);
              
			   while($row = mysql_fetch_assoc($w))
               {    echo "<tr>";
					if($row['state']==2)
                        echo "<td align='center'>���δͨ��</td>"; 
					else
                        echo "<td align='center'>�����</td>"; 
                    
                    echo "<td align='center'>".$row['studentid']." </td>";
					echo "<td align='center'>".$stgrow[0]." </td>"; 
                    echo "<td align='center'><a href='../student/uploads/{$row['filename']}'>".$row['filename']."</a> </td>";   
                    if($row['task']==5)
						echo "<td align='center'>������</td>";
					elseif ($row['task']==6)
						echo "<td align='center'>���ⱨ��</td>";
					elseif ($row['task']==7)
						echo "<td align='center'>��������</td>";
					elseif ($row['task']==8)
						echo "<td align='center'>���ķ���</td>";
					elseif ($row['task']==9) 
						echo "<td align='center'>���ڼ���</td>";
					elseif ($row['task']==10) 
						echo "<td align='center'>��ҵ����һ��</td>";
					elseif ($row['task']==11)
						echo "<td align='center'>��ҵ���Ķ���</td>";
					elseif ($row['task']==12)
						echo "<td align='center'>��ҵ��������</td>";
					elseif ($row['task']==13)
						echo "<td align='center'>����</td>"; 
                    if($row['state']==0)
                  {
                    echo "<td align='center'><a href='teacher.php?id={$row['studentid']}&task=$task&state={$row['state']}'>���</a></td>";
                  }
                  else{
                    echo "<td align='center'><a href='teachercheck.php?id={$row['studentid']}&task=$task&state={$row['state']}'>�鿴</a></td>";
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
            
				<td colspan="2" style="color:red">δ�ύ</td>
				</tr><tr>
                <td align="center">ѧ��</td>
                <td align="center">����</td>              
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
						//echo "<td align='center'>δ�ύ</td>";
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