<?php
    session_start();//�����Ự
?>
<?php
    if(empty($_SESSION["tch"]["id"])){
		echo "<script>alert('���ȵ�¼');window.location.href=\"../denglu/login.php\";</script>";
		exit;
	}
?>
<?php
     $addtime=time();
     $id=@$_SESSION["tch"]["id"];
     include ("dbconfig.php");
     $con = mysql_connect(HOST,USER,PASS);//����mysql
      mysql_select_db(DBNAME,$con);//�������ݿ�
      mysql_query("set names 'GB2312'") ;
      for ($j=1; $j< 14; $j++) { 
         $tktime="select * from timedb where taskid=$j"; 
         $a=mysql_query($tktime,$con);
         $s=mysql_fetch_array($a);
         if($s>1){
         if($addtime<$s['starttime'])
      {
        $base[$j]="δ��ʼ";
      }else if ($addtime>=$s['starttime']&&$addtime<=$s['endtime']) {
        $base[$j]="������";
      }else if ($addtime>$s['endtime']) {
          $base[$j]="�ѽ�ֹ";
      }}
      else  {
          $base[$j]="δ��ʼ";
      }
      }
      for ($i=5; $i < 14; $i++) { 
      $tktime="select * from timedb where taskid=$i";  
      $q=mysql_query($tktime,$con);
      $w=mysql_fetch_array($q);
      if($w>1){
      if ($addtime>=$w['starttime']&&$addtime<=$w['endtime']) {
			$tasknum=$i;
      }else if ($addtime>$w['endtime']) {
				$tasknum=$i;
			}
			}
      } 
		if(empty($tasknum))
			$tasknum=4;
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
				<center>
        
       <table  class="table table-striped table-bordered table-hover" style="width:80%;margin-top:20px;">
	  <tr style="background-color: #F3F3FA;" >
		            <td align="center">����</td>
                <td align="center">������</td>
                <td align="center">���ⱨ��</td>
                <td align="center">��������</td>
				<td align="center">���ķ���</td>
                <td align="center">���ڼ���</td>
                <td align="center">��ҵ����һ��</td>
				<td align="center">��ҵ���Ķ���</td>
				<td align="center">��ҵ��������</td>
                <td align="center">����</td>
            </tr>
                <?php
					$sqlsid="select studentid from informationdb where teacherid=$id";
					$resultsid=mysql_query($sqlsid);
					while($rowsid=@mysql_fetch_array($resultsid)){
						$sid=$rowsid["studentid"];//get studentid
						
						$stg="select name from studentdb where Id={$sid}";
						$stgr=mysql_query($stg);
						$stgrow=@mysql_fetch_array($stgr);//get student name
						
						echo "<tr>";
						echo "<td>".$stgrow[0]."</td>";
						
						for($task_id=5;$task_id<=@$tasknum;$task_id++){
							$sqlstate="select state from filedb where studentid=$sid and task=$task_id";
							$resultpd=mysql_query($sqlstate);
							$rowpd=@mysql_fetch_array($resultpd);					
							
							if($rowpd){
								$resultstate=mysql_query($sqlstate);
								while($rowstate=@mysql_fetch_array($resultstate))
									$rowstate2=$rowstate;
								if($rowstate2[0]==0)
									echo "<td><font color='#5bc0de'>�����</font></td>";
								else if($rowstate2[0]==2)
									echo "<td><font color='#b9534f'>δͨ��</font></td>";
								else if($rowstate2[0]==1)
									echo "<td><font color='#5cb85c'>��ͨ��</font></td>";
							}else
								echo "<td><font color='#f0ad4e'>δ�ύ</font></td>";
						}
						for($i=@$tasknum+1;$i<14;$i++)
							echo "<td><font color='gray'>δ��ʼ</font></td>";
					}?>
		</table>
		</center>
	</div>
	</body>
</html>