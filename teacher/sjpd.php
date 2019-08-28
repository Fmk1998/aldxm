<?php
    session_start();
if(empty($_SESSION["tch"]["id"])){
		echo "<script>alert('请先登录');window.location.href=\"../denglu/login.php\";</script>";
		exit;
	}
?>
 <?php
header("Content-Type: text/html;charset=gb2312");
	include ("dbconfig.php");
    $con = mysql_connect(HOST,USER,PASS);
    $addtime=time();
    @$taskid=$_GET["taskid"];
	@$id=$_SESSION["tch"]["id"];
	if(empty($id))
        echo "<script>alert('请先登录');window.location.href=\"../denglu/login.php\";</script>";
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
			if($taskid==1)
			header("Location:../teacher/tjxt.php");	
			else if($taskid==3)	
			header("Location:../teacher/xzxs1.php");		
			else if($taskid==4)
			header("Location:../teacher/xzxs2.php");	
        }
		else
			echo "<script>alert('不在时间段内');window.location.href=\"../teacher/Index_ht.php\";</script>";
   }
   mysql_close($con);

?>