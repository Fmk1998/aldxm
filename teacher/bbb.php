<?php
session_start();
header("Contect-Type:text/html;charsrt=gb2312");
if(empty($_SESSION["tch"]["id"])){
		echo "<script>alert('请先登录');window.location.href=\"../denglu/login.php\";</script>";
		exit;
	}
  @$sid=$_POST["checkbox"];
  @$pid=$_POST["pid"];
	include ("dbconfig.php");
	$con = mysql_connect(HOST,USER,PASS);//连接mysql
	mysql_select_db(DBNAME,$con);//连接数据库
	mysql_query("set names 'GB2312'") ;
	$s="select count(*) from ptable where pfid = $pid";
	$d=mysql_query($s);
	$f=@mysql_fetch_array($d);
	$c="select * from ttable where pid = $pid";
	$v=mysql_query($c);
	$b=@mysql_fetch_array($v);
	$num=$b['ppnum']-count($sid)-$f[0];
	if($num<0){
	echo "<script>alert('人数达到上限!');history.go(-1);</script>";
	}
	else{
  if(count($sid)==0)
	  echo "<script>alert('请选择学生');history.go(-1);</script>";
  else{
  for($i=0;$i<count($sid);$i++) 
  { 
	$sql_update="update ptable set pfid=".$pid." where sid=".$sid[$i];		
	$res_update=mysql_query($sql_update);
	$sql_insert="INSERT INTO informationdb (studentid,teacherid) VALUES ('".$sid[$i]."','".$b['tid']."')";
	$res_insert=mysql_query($sql_insert);
	echo "<script>alert('选择成功');history.go(-1);</script>";
  }
	}}
?>