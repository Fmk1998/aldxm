<?php
    session_start();
?>
 <?php
header("Content-Type: text/html;charset=gb2312");
	include ("dbconfig.php");
    $con = mysql_connect(HOST,USER,PASS);
    $addtime=time();
    @$taskid=$_GET["taskid"];
	@$studentid=$_SESSION["login"]["id"];
	if(empty($studentid))
        echo "<script>alert('���ȵ�¼');window.location.href=\"../denglu/login.php\";</script>";
    else
    {
        mysql_select_db("sjdb",$con);
        mysql_query("set names 'GB2312'");
        $a="select * from timedb where taskid={$taskid}";
        $b=@mysql_query($a,$con) ; 
        $c=@mysql_fetch_array($b) ; 
        $starttime=$c['starttime'];
        $endtime=$c['endtime'];
        if($endtime>=$addtime&&$addtime>=$starttime)
        {
			if($taskid==2){
				$sqlpfid="select pfid from ptable where sid='".$studentid."'";
				$querysql=mysql_query($sqlpfid);
				$rowsql=@mysql_fetch_array($querysql);
				if($rowsql){
					echo "<script>alert('���Ѿ��־Ը��!');window.location.href=\"../student/mbxz.html\";</script>";
					exit;
				}
				else{
					header("Location:../student/tbzy.php");
					@$_SESSION["task"]=$taskid;
					exit;
				}
			}
			$sql1="select * from filedb where studentid='$studentid' and task='$taskid'";
			$result1=mysql_query($sql1);
			$result2=mysql_query($sql1);
			$rowp=@mysql_fetch_array($result1);
			if(empty($rowp)){
				header("Location:../student/tijiao.html");
				@$_SESSION["task"]=$taskid;
			}	
			else{
				while($row1=@mysql_fetch_array($result2)) 
					@$row2=$row1;//the last data
				if(@$row2["state"]==0){
					echo "<script>alert('ָ����ʦδ���,�ٴ��ύ�����滻�ϴ����ύ���ļ�!');window.location.href=\"../student/tijiao.html\";</script>";
					@$_SESSION["task"]=$taskid;
				}
				else{
					$file_dir="../student/uploads/";
					$wordname=$row2["filename"];
					if(!file_exists($file_dir . $wordname)){//check file
						header("Location:../student/tijiao.html");
						@$_SESSION["task"]=$taskid;
					}
					else 
						header("Location:../student/teacherbrief.php");
				}			
			}
        }
		else
			echo "<script>alert('����ʱ�����');window.location.href=\"../student/mbxz.html\";</script>";
   }
   mysql_close($con);
?>