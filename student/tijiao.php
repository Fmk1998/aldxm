<?php
    session_start();//开启会话
?>
<?php
	header("Content-type: text/html; charset=gb2312"); 
	if(empty($_SESSION["login"]["id"]))
        echo "<script>alert('请先登录');window.location.href=\"../denglu/login.php\";</script>";
	else{
		include ("dbconfig.php");
 		include ("functions.php");
		$con = mysql_connect(HOST,USER,PSW);
        mysql_select_db(dbname,$con);
        mysql_query("set names 'GB2312'");

		$studentid=$_SESSION["login"]["id"];
		
		@$task=$_SESSION["task"];
		if(empty($task)){
			echo "<script>alert('请重新选择要提交的任务!');location.href=\"mbxz.html\";</script>";
			exit;
		}
		
		$time=time();
		$sqltime="select * from timedb where taskid=$task";
		$sqltr=mysql_query($sqltime);
		$sqltrow=@mysql_fetch_array($sqltr);
        if($time>$sqltrow["endtime"]){
			echo "<script>alert('任务时间已结束!');location.href=\"mbxz.html\";</script>";
			exit;
		}
		
		$sql1="select * from filedb where studentid='$studentid' and task='$task'";
		$result1=@mysql_query($sql1);
		while($row1=@mysql_fetch_array($result1))
			$row2=$row1;
		if(empty($row2)){
			$result_up=uploadFile("filename","./uploads");//upload file
			if($result_up["error"]==false){
				echo "<script>alert('上传失败:".$result_up['info']."');history.go(-1);</script>";	
				exit;
			}			
			else{
				$name= $result_up["info"];//get file's name 
				$state=0;
			
				$sql="insert into filedb (studentid,task,filename,state) values('$studentid','$task','$name','$state')";
				//$sql="UPDATE filedb SET filename='{$name}',state='{$state}' where studentid='$studentid' and task='$task'";
				$result=@mysql_query($sql);
				echo "<script>alert('上传成功!');history.go(-1);</script>";	
			}
		}else{
			if($row2["state"]==0){
				$wordname=$row2["filename"];//file's name
				$result_up=uploadFile("filename","./uploads");//upload file
				if($result_up["error"]==false){
					echo "<script>alert('上传失败:".$result_up['info']."');history.go(-1);</script>";	
					exit;
				}
				else
					$name= $result_up["info"];//get file's name 				
				$sql="UPDATE filedb SET filename='{$name}' where studentid='$studentid' and task='$task' and state=0";
				$result=mysql_query($sql);
				@unlink("uploads/".$wordname);//delete file
				echo "<script>alert('修改成功!');history.go(-1);</script>";
			}
			else{
				$file_dir="uploads/";
				$wordname=$row2["filename"];
				if(!file_exists($file_dir . $wordname)){//check file
					$result_up=uploadFile("filename","./uploads");//upload file
					if($result_up["error"]==false){
						echo "<script>alert('上传失败:".$result_up['info']."');history.go(-1);</script>";	
						exit;
					}
					else
						$name= $result_up["info"];//get file's name 					
					$state=0;
					
					$sql="insert into filedb (studentid,task,filename,state) values('$studentid','$task','$name','$state')";
					$result=mysql_query($sql);
					echo "<script>alert('上传成功!');history.go(-1);</script>";
				}else			
					header("Location: teacherbrief.php");
			}
		}
	}
	mysql_close($con);
?>