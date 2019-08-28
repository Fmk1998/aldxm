<?php
	session_start();
	header("Contect-Type:text/html;charsrt=gb2312");
	if(empty($_SESSION["tch"]["id"])){
		echo "<script>alert('请先登录');window.location.href=\"../denglu/login.php\";</script>";
		exit;
	}
	include("dbconfig.php");
	$ktname=$_POST['ktname'];
	$kttype=$_POST['kttype'];
	$ktnature=$_POST['ktnature'];
	$ktsource=$_POST['ktsource'];
	$pcontent=$_POST['text1'];
	$plevel=$_POST['text2'];
	$pcondition=$_POST['text3'];
    $pid=$_POST['pid'];
	if(empty($pid)){
		echo "<script>alert('非法操作');window.location.href=\"../denglu/login.php\";</script>";
		exit;
	}
	if($ktname==""||$kttype==""||$ktnature==""||$ktsource==""||$pcontent==""||$plevel==""||$pcondition==""||$ppunm<=0||ctype_space($ktname)||ctype_space($kttype)||ctype_space($ktnature)||ctype_space($ktsource)||ctype_space($pcontent)||ctype_space($plevel)||ctype_space($pcondition))
		echo "<script>alert('信息不完整或人数上限的数值不合法');history.go(-1);</script>";
	else
	{
		$con=mysql_connect(HOST,USER,PASS);
		mysql_select_db(sjdb,$con);
	    mysql_query("set names 'gb2312'");
		$sql = "update ttable SET ptitle='{$ktname}',ptype='{$kttype}',pcha='{$ktnature}',psource='{$ktsource}',pcontent='{$pcontent}',plevel='{$plevel}',pcondition='{$pcondition}'WHERE pid={$pid}";
		$result=mysql_query($sql) ;
		echo "<script>alert('修改成功');location.href='lsck.php';</script>";
		break;
	}

?>