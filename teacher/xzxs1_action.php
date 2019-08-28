<?php
		session_start();
		if(empty($_SESSION["tch"]["id"])){
			echo "<script>alert('请先登录');window.location.href=\"../denglu/login.php\";</script>";
			exit;
		}
		@$pid=$_GET["id"];
		include ("dbconfig.php");
		$con = mysql_connect(HOST,USER,PASS);//连接mysql
		mysql_select_db(DBNAME,$con);//连接数据库
		mysql_query("set names 'GB2312'") ;
		@$sid[]=0;$i=1;
		$s="select count(*) from ptable where pfid = $pid";
		$d=mysql_query($s);
		$f=@mysql_fetch_array($d);
		$c="select * from ttable where pid = $pid";//查找上限人数
		$v=mysql_query($c);
		$b=@mysql_fetch_array($v);
		$num=$b['ppnum']-$f[0];
		$e="select sid,Name from studentdb,ptable where ptable.pid1=$pid and ptable.sid=studentdb.Id and pfid is null";//查找第一志愿选择该项目的信息
		$q=mysql_query($e,$con);
		$m="select sid,Name from studentdb,ptable where ptable.sid=studentdb.Id and pfid=$pid";//查找已确定为该项目的人
        $j=mysql_query($m,$con);
		$u="select * from studentdb,ptable where ptable.pid1=$pid and ptable.sid=studentdb.Id and pfid is null";//查找第一志愿选择该项目的人数且没有被选择的人
		$o=mysql_query($u,$con);
		$peoplenum=@mysql_num_rows($o);	
		$sid[$i]["peoplenum"]=$peoplenum;//总人数
		$sid[$i]["num"]=$num;//可选人数
		$sid[1]["pid"]=$pid;
	while($w=@mysql_fetch_array($q)){
		$w["Name"]=iconv("GB2312","utf-8//ignore",$w["Name"]);
		$sid[$i]["Namenot"]=$w["Name"];
		$sid[$i]["sidnot"]=$w["sid"];
		$i++;
	}
		$snum=0;$ii=1;
	while($k=@mysql_fetch_array($j)){
		$k["Name"]=iconv("GB2312","utf-8//ignore",$k["Name"]);
		$sid[$ii]["Nameyes"]=$k["Name"];
		$sid[$ii]["sidyes"]=$k["sid"];
		$sid[1]["yesi"]=$ii;
		$snum++;	
        $ii++;	
	}
		$sid[1]["snum"]=$snum;
	echo json_encode($sid);
?>