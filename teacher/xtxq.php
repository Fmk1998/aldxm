<!DOCTYPE html>
<html>
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
								<div name="ckxt">
								<center>
							<?php
								@$pid=$_POST['pid'];
								if(empty($pid)){
									echo "<script>alert('�Ƿ���ת');history.go(-1);</script>";
									exit;
								}
								$sql=mysql_query("select * from ttable,teacherdb where ttable.pid=$pid and ttable.tid=teacherdb.Id");
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
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>

</html>