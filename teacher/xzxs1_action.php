<?php
		session_start();
		if(empty($_SESSION["tch"]["id"])){
			echo "<script>alert('���ȵ�¼');window.location.href=\"../denglu/login.php\";</script>";
			exit;
		}
		@$pid=$_GET["id"];
		include ("dbconfig.php");
		$con = mysql_connect(HOST,USER,PASS);//����mysql
		mysql_select_db(DBNAME,$con);//�������ݿ�
		mysql_query("set names 'GB2312'") ;
		@$sid[]=0;$i=1;
		$s="select count(*) from ptable where pfid = $pid";
		$d=mysql_query($s);
		$f=@mysql_fetch_array($d);
		$c="select * from ttable where pid = $pid";//������������
		$v=mysql_query($c);
		$b=@mysql_fetch_array($v);
		$num=$b['ppnum']-$f[0];
		$e="select sid,Name from studentdb,ptable where ptable.pid1=$pid and ptable.sid=studentdb.Id and pfid is null";//���ҵ�һ־Ըѡ�����Ŀ����Ϣ
		$q=mysql_query($e,$con);
		$m="select sid,Name from studentdb,ptable where ptable.sid=studentdb.Id and pfid=$pid";//������ȷ��Ϊ����Ŀ����
        $j=mysql_query($m,$con);
		$u="select * from studentdb,ptable where ptable.pid1=$pid and ptable.sid=studentdb.Id and pfid is null";//���ҵ�һ־Ըѡ�����Ŀ��������û�б�ѡ�����
		$o=mysql_query($u,$con);
		$peoplenum=@mysql_num_rows($o);	
		$sid[$i]["peoplenum"]=$peoplenum;//������
		$sid[$i]["num"]=$num;//��ѡ����
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