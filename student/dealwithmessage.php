<?php
	session_start();
	@$studentid=$_SESSION["login"]["id"];//get studentid
	if(empty($studentid)){
		echo "<script>alert('请先登录');window.location.href=\"../denglu/login.php\";</script>";
		exit;
	}
	include ("dbconfig.php");
	$con = mysql_connect(HOST,USER,PSW);
	mysql_select_db(dbname,$con);
	mysql_query("set names 'GB2312'");
	
	$time=time();
	$a="select * from timedb order by taskid";
	$ar=@mysql_query($a);
	for($m=1;$m<=13;$m++)
		$task[$m]=2;
	$m=1;
	while($row=@mysql_fetch_array($ar)){
		@$m=$row["taskid"];
		if($row['endtime']>=$time&&$time>=$row['starttime'])
			$task[$m]=1;
		else if($row["endtime"]<$time)
			$task[$m]=0;
	}
	echo json_encode($task);
?>