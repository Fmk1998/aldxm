<?php
	session_start();
	@$sid=$_SESSION["login"]["id"];//get studentid
	if(empty($sid)){
		echo "<script>alert('���ȵ�¼');window.location.href=\"../denglu/login.php\";</script>";
		exit;
	}
	include("dbconfig.php");
	header("Content-Type: text/html;charset=gb2312");
	$con = mysql_connect(HOST,USER,PSW);
	mysql_select_db(dbname,$con);
	mysql_query("set names 'GB2312'");
	switch(@$_GET["action"])
	{
		case "kt":
			$data=array();
			$tid1st=$_GET["tidfirst"];
			$sql=mysql_query("select pid,ptitle from ttable where tid='$tid1st'");
			$i=0;
			while ($row=@mysql_fetch_assoc($sql)) {
				$data[$i]["pid"]=$row["pid"];
				$row["ptitle"]=iconv('gb2312','utf-8',$row["ptitle"]);
				$data[$i]["ptitle"]=$row["ptitle"];
				$i++;
			}
			echo json_encode($data);
			break;
		case "submit":
			@$pid1=$_POST["pid1"];
			@$pid2=$_POST["pid2"];
			if($pid1==""||$pid2=="")
				echo "<script>alert('��ѡ������');history.go(-1);</script>";
			else{
				$a=mysql_query("select sid from ptable where sid='$sid'");
				$b=@mysql_fetch_array($a);
				if($b){
					echo "<script>alert('�����־Ը');history.go(-1);</script>";
				}
				else{
					if($pid1==$pid2){
						echo "<script>alert('����־Ը������ͬ');history.go(-1);</script>";
					}
					else{
						mysql_query("insert into ptable(sid,pid1,pid2) values('$sid','$pid1','$pid2')");
						echo "<script>alert('��ɹ�');window.location.href=\"../student/mbxz.html\";</script>";
					}
				}
			}
		break;
	}
?>