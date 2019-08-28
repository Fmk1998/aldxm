<?php
	session_start();
	if(empty($_SESSION["gly"]["id"])){
		echo "<script>alert('请先登录');window.location.href=\"../denglu/login.php\";</script>";
		exit;
	}
	header("Content-Type: text/html;charset=gb2312");
	$tid=@$_GET["tid"];
	$sid=@$_GET["sid"];
	
	include ("dbconfig.php");
	$con=mysql_connect(HOST,USER,PASS);
	mysql_select_db(DBNAME,$con);
	mysql_query("set names 'gb2312'");
	
	$pid[]=$sid;$i=1;
	/*
	$sql="select pid,ptitle,ppnum,count(*) as num from ttable,ptable where ttable.tid='".$tid."' and ptable.pfid=ttable.pid";
	$sqlquery=mysql_query($sql);
	while($sqlr=@mysql_fetch_array($sqlquery)){
		if($sqlr["num"]<$sqlr["ppnum"]){
			$pid[$i]["pid"]=$sqlr["pid"];
			$sqlr["ptitle"]=iconv("GB2312","utf-8//ignore",$sqlr["ptitle"]);
			$pid[$i]["ptitle"]=$sqlr["ptitle"];
			$i++;
		}
	}*/
	
	$sqlmaxnum="select pid,ptitle,ppnum from ttable where tid='".$tid."'";
	$dosql=mysql_query($sqlmaxnum);
	while($rowsql=@mysql_fetch_array($dosql)){
		$pfid=$rowsql["pid"];
		$sqlpnum="select count(*) from ptable where pfid='".$pfid."'";
		$dosqlnum=mysql_query($sqlpnum);
		$rowsqlnum=mysql_fetch_array($dosqlnum);
		if($rowsqlnum[0]<$rowsql["ppnum"]){
			$pid[$i]["pid"]=$rowsql["pid"];
			$rowsql["ptitle"]=iconv("GB2312","utf-8//ignore",$rowsql["ptitle"]);
			$pid[$i]["ptitle"]=$rowsql["ptitle"];
			$i++;
		}
	}
	
	if(empty($pid[1])){
		$pid[1]=0;
	}
	echo json_encode($pid);
?>