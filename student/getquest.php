<?php
	session_start();
	@$studentid=$_SESSION["login"]["id"];//get studentid
	if(empty($studentid)){
		echo "<script>alert('请先登录');window.location.href=\"../denglu/login.php\";</script>";
		exit;
	}
	@$quest=$_SESSION["task"];
	echo json_encode($quest);
?>