<?php
session_start();
header("Contect-Type:text/html;charsrt=gb2312");
if(empty($_SESSION["tch"]["id"])){
		echo "<script>alert('���ȵ�¼');window.location.href=\"../denglu/login.php\";</script>";
		exit;
	}
  @$sid=$_POST["checkbox"];
  @$pid=$_POST["pid"];
	include ("dbconfig.php");
	$con = mysql_connect(HOST,USER,PASS);//����mysql
	mysql_select_db(DBNAME,$con);//�������ݿ�
	mysql_query("set names 'GB2312'") ;
	$s="select count(*) from ptable where pfid = $pid";
	$d=mysql_query($s);
	$f=@mysql_fetch_array($d);
	$c="select * from ttable where pid = $pid";
	$v=mysql_query($c);
	$b=@mysql_fetch_array($v);
	$num=$b['ppnum']-count($sid)-$f[0];
	if($num<0){
	echo "<script>alert('�����ﵽ����!');history.go(-1);</script>";
	}
	else{
  if(count($sid)==0)
	  echo "<script>alert('��ѡ��ѧ��');history.go(-1);</script>";
  else{
  for($i=0;$i<count($sid);$i++) 
  { 
	$sql_update="update ptable set pfid=".$pid." where sid=".$sid[$i];		
	$res_update=mysql_query($sql_update);
	$sql_insert="INSERT INTO informationdb (studentid,teacherid) VALUES ('".$sid[$i]."','".$b['tid']."')";
	$res_insert=mysql_query($sql_insert);
	echo "<script>alert('ѡ��ɹ�');history.go(-1);</script>";
  }
	}}
?>