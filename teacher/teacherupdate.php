<?php
    session_start();
	header("Contect-Type:text/html;charsrt=gb2312");
	if(empty($_SESSION["tch"]["id"])){
		echo "<script>alert('���ȵ�¼');window.location.href=\"../denglu/login.php\";</script>";
		exit;
	}
    @$state = $_POST["state"];
	if($state=="")
		echo "<script>alert('��Ϣ������!');history.go(-1);</script>";
	else{
		@$brief = $_POST["brief"];
		@$id=$_POST["id"];
        @$task=$_POST["task"];
		@$tid=$_SESSION["tch"]["id"];
		include ("dbconfig.php");
		$con = mysql_connect(HOST,USER,PASS);
		mysql_select_db(DBNAME,$con);
		mysql_query("set names 'GB2312'");
		$sql_update="update filedb set state='{$state}',brief='{$brief}' where studentid={$id} and task={$task} and state=0";			
		$res_update=mysql_query($sql_update);
		echo "<script>alert('�ύ�ɹ�!');history.go(-1);</script>";
		header("Location: Index_ht.php?task=$task");
		mysql_close($con); 
	}	
?>