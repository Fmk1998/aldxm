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
			<?php
				@$id=$_SESSION['tch']['id'];
				$sql=mysql_query("select Name from teacherdb where Id=$id");
				$row=mysql_fetch_assoc($sql);
				?>
				<div style="width: 82%;float:right;">
				<div name="tjxt">
					<center>
					<form method="POST" action="action.php">
						 <table class="table table-striped table-bordered table-hover" style="width: 70%;margin-top: 15px;">
						   <tbody>
							 <tr>
							   <td style="width:100px;"><strong>����</strong></td>
							   <td><?php echo $row['Name'];?></td>
							 </tr>
							 <tr>
							   <td><strong>��������</strong></td>
							   <td><input type="text" name="ktname"class="form-control" ></td>
							 </tr>
							 <tr>
							   <td><strong>��������</strong></td>
							   <td>
							   <input type="radio" checked="checked" name="kttype" value="����"><span>����&nbsp;&nbsp;&nbsp;&nbsp;
							   <input type="radio" name="kttype" value="���"><span>���&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							   <input type="radio" name="kttype" value="���������"><span>���������&nbsp;
							   </td>
							 </tr>
							 <tr>
							   <td><strong>��������</strong></td>
							   <td>
							   <input type="radio" checked="checked" name="ktnature" value="����̽��"><span>����̽��&nbsp;&nbsp;&nbsp;&nbsp;
							   <input type="radio" name="ktnature" value="ʵ��Ӧ��"><span>ʵ��Ӧ��
							   </td>
							 </tr>
							 <tr>
							   <td><strong>������Դ</strong></td>
							   <td>
							   <input type="radio" checked="checked" name="ktsource" value="���ʵ��"><span>���ʵ��&nbsp;&nbsp;&nbsp;&nbsp;
							   <input type="radio" name="ktsource" value="��Ͻ�ʦ����"><span>��Ͻ�ʦ����
							   </td>
							 </tr>
							 <tr>
							   <td><strong>��Ҫ�о����ݼ��ɹ���ʽ</strong></td>
							   <td><textarea  name="text1" class="form-control"></textarea></td>
							 </tr>
							 <tr>
							   <td><strong>�Ѷȷ����ۺ�ѵ�����</strong></td>
							   <td><textarea name="text2" class="form-control"></textarea></td>
							 </tr>
							 <tr>
							   <td><strong>���������ʹ�ʩ</strong></td>
							   <td><textarea name="text3" class="form-control"></textarea></td>
							 </tr>
						   </tbody>
						 </table>
						 <input type="submit" class="btn btn-primary" value="����" style="width:200px;"/>
						 </form>
					 </center>
					 </div>
				</div>
        </div>
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>

</html>