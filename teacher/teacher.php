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
	  
    @$id=$_GET["id"];
    @$tid=$_SESSION["tch"]["id"];
    @$task=$_GET["task"];
    @$state=$_GET["state"];
	if($state!=0){
		echo "<script>alert('�Ƿ���ת!');window.location.href=\"Index_ht.php?task=$task\";</script>";
		exit;
	}
	$stg="select name from studentdb where Id={$id}";
	$stgr=mysql_query($stg);
	$stgrow=@mysql_fetch_array($stgr);
        $sql_select="select * from filedb where studentid={$id} and task={$task} and state={$state}";
        $res_select=mysql_query($sql_select,$con);
        $row= @mysql_fetch_array($res_select);
		if(!$row){
			echo "<script>alert('û���ҵ�Ҫ�鿴����Ϣ!');window.location.href=\"Index_ht.php?task=$task\";</script>";
			exit;
		}
        mysql_close($con); 
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
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link type="text/css" href="css/index.css" rel="stylesheet" />
	<script type="text/javascript" src="js/index.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
	    <script language="javascript">
function checkup()
{
  if(window.confirm("ȷ��Ҫ�ύ��"))
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
        <center>
    <form action="teacherupdate.php" method="post">
    <input type="hidden" value="<?php echo $task; ?>" name="task">
	<input type="hidden" value="<?php echo $row['studentid']; ?>" name="id">
    <table class="table table-striped table-bordered table-hover" style="width: 70%;margin-top: 15px;">
	<tbody>
     <tr>
        <td align="center">ѧ��</td>
       <td><?php echo  $row['studentid'];?></td>
    </tr>
    <tr>
        <td align="center">����</td>
        <td><?php echo $stgrow[0];?></td>
    </tr>
    <tr>
        <td align="center">��������:</td>
        <td> <?php echo $row['filename'];?></td>
    </tr>
    <tr>
        <td align="center">�������:</td>
        <td>
		<?php
		if($task==5)
		   echo "������";
		else if ($task==6) 
		   echo "���ⱨ��";
		else if ($task==7)
		   echo "��������";
		else if ($task==8)
		   echo "���ķ���";
		else if ($task==9)
		   echo "���ڼ���";
		else if ($task==10)
		   echo "��ҵ����һ��";
		else if ($task==11)
		   echo "��ҵ���Ķ���";
		else if ($task==12)
		   echo "��ҵ��������";
		else if ($task==13)
		   echo "����";
	?>
 </td>
    </tr>
    <tr>
        <td align="center">���״̬:</td>
        <td><input type="radio" value="1" name="state" onclick="if(this.c==1){this.c=0;this.checked=0;}else{this.c=1;}" c="0">&nbsp;ͨ��
        <input type="radio" value="2" name="state" onclick="if(this.cc==1){this.cc=0;this.checked=0;}else{this.cc=1;}" cc="0">&nbsp;��ͨ��</td>
    </tr>
    <tr>
        <td align="center" valign="top">����</td>
        <td><textarea cols="25" rows="5" class="form-control" name="brief" ><?php echo $row['brief'];?></textarea></td>
    </tr>
    <tr>
        <td colspan="2" align="center">
        <input type="Submit" id="button" value="�ύ" class="btn btn-primary" onclick="return checkup()" style="width:150px;"/>
        
    </td>
    </tr>
	</tbody>
    </table>   
    </form>
    </center>
	</div>
	</body>
</html>