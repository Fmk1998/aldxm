<?php
    session_start();
?>
<?php
	header("Content-Type: text/html;charset=gb2312");
	if(empty($_SESSION["gly"]["id"]))
        echo "<script>alert('���ȵ�¼,�ڽ��в���');window.location.href=\"../denglu/login.php\";</script>";
	else{
		@$taskid=$_POST["taskid"];
		@$start=$_POST["start"];
		@$end=$_POST["end"];

		if($start==""||$end==""||$taskid=="")
			echo "<script>alert('���벻��Ϊ��!');history.go(-1);</script>";
		else{
			@$start=strtotime($start);
			@$end=strtotime($end);
			if($end<$start)
				echo "<script>alert('�����ֹʱ��Ӧ���ڿ�ʼʱ��!');history.go(-1);</script>";
			else{
				include ("dbconfig.php");
				$con=mysql_connect(HOST,USER,PASS);
				mysql_select_db(DBNAME,$con);
				mysql_query("set names 'GB2312'");
				
				$sql="select * from timedb where taskid=$taskid";
				$result=mysql_query($sql);
				$row=@mysql_fetch_array($result);
				if(!empty($row)){
					echo "<script>alert('��������ʱ��������!');history.go(-1);</script>";
					exit;
				}
				
				if($taskid>1){
					$taskid1=$taskid-1;
					$sql1="select * from timedb where taskid=$taskid1";
					$result=mysql_query($sql1);
					$row=@mysql_fetch_array($result);
					if(empty($row))
						echo "<script>alert('���������ϴ�����ʱ��!');history.go(-1);</script>";
					else{
						if($row["starttime"]>=$start)
							echo "<script>alert('��������ʼʱ��Ӧ�����ϴ�����ʼʱ��!');history.go(-1);</script>";
						else{
							$sql="insert into timedb (starttime,endtime,taskid) values('$start','$end','$taskid')";
							$result=@mysql_query($sql);
							echo "<script>alert('ʱ�����óɹ�!');history.go(-1);</script>";
						}
					}					
				}
				else{
					$sql="insert into timedb (starttime,endtime,taskid) values('$start','$end','$taskid')";
					$result=@mysql_query($sql);
					echo "<script>alert('ʱ�����óɹ�!');history.go(-1);</script>";
				}
			}
		}				
	}	
?>