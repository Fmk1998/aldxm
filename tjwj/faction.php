<?php
    session_start();
	header("Content-Type: text/html;charset=gb2312");
	if(empty($_SESSION["gly"]["id"])){
		echo "<script>alert('���ȵ�¼');window.location.href=\"../denglu/login.php\";</script>";
		exit;
	}
	
	$page=@$_POST["page"];
	$pid=@$_POST["pid"];
	$sid=@$_POST["sid"];
	$tid=@$_POST["tid"];
	if(empty($pid)||empty($sid)){
		echo "<script>alert('��Ϣ��ȫ,������ѡ��');window.location.href=\"fpxs.php?page=".$page."\";</script>";
		exit;
	}
	
	include ("dbconfig.php");
	$con=mysql_connect(HOST,USER,PASS);
	mysql_select_db(DBNAME,$con);
	mysql_query("set names 'gb2312'");
	
	$sqlcheck="select * from ptable where sid='".$sid."'";
	$dosql=mysql_query($sqlcheck);
	$sqlr=@mysql_fetch_array($dosql);
	if($sqlr["pfid"]!=null){
		echo "<script>alert('��������ѡ��');window.location.href=\"fpxs.php?page=".$page."\";</script>";
		exit;
	}
	if($sqlr["sid"]==null)
		$sql="insert into ptable (sid,pfid) values('".$sid."','".$pid."')";
	else
		$sql="update ptable set pfid='".$pid."' where sid='".$sid."'";
	$sqlquery=mysql_query($sql);
	$sqlinfo="insert into informationdb (studentid,teacherid) values('".$sid."','".$tid."')";
	$dosqlinfo=mysql_query($sqlinfo);
	echo "<script>alert('����ɹ�');window.location.href=\"fpxs.php\";</script>";
?>