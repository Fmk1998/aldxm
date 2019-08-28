<?php
    header("Content-Type: text/html;charset=GB2312");
	session_start();
   	@$link = mysql_connect("localhost","root","root");
	@mysql_select_db("sjdb",$link);
	mysql_query("set names 'GB2312'");

	switch ($_GET["action"]) {
		case 'login':
		    $typeid = $_POST["typeid"];
			$id = $_POST["id"];
            $Password = $_POST["Password"];
            if($typeid==1||empty($id)||empty($Password)){
            	echo "<script>alert('请将信息填写完整！');history.go(-1);</script>";
            }
            switch ($typeid) {
            	//老师
            	case '2':
            		$user = mysql_query("SELECT Id FROM teacherdb WHERE Id = '$id'");
            		@$user1=mysql_fetch_assoc($user);
            		if(!$user1){
            			echo "<script>alert('用户名不存在！');history.go(-1);</script>";
            		}else{
            			$password = mysql_query("SELECT Password FROM teacherdb WHERE Id = '$id'");
            			@$password1 = mysql_fetch_array($password);
            			if($Password == $password1['Password']){
            				/*$Nam = mysql_query("SELECT Name FROM teacherdb WHERE Id = '$id'");            				
            				$Name = mysql_fetch_array($Nam);*/
            				header("Location:../teacher/Index_ht.php");
							$_SESSION["tch"]["id"]=$id;
                            $_SESSION["typeid"]=$typeid;
            			}else{
            				echo "<script>alert('密码错误，登录失败！');history.go(-1);</script>";
            			}
            		}
            		break;
            		
            	//学生
            	case '3':
            		$user = mysql_query("SELECT Id FROM studentdb WHERE Id = '$id'");
            		@$user1=mysql_fetch_assoc($user);
            		if(!$user1){
            			echo "<script>alert('用户名不存在！');history.go(-1);</script>";
            		}else{
            			$password = mysql_query("SELECT Password FROM studentdb WHERE Id = '$id'");
            			@$password1 = mysql_fetch_array($password);
            			if($Password == $password1['Password']){
            				/*$Nam = mysql_query("SELECT Name FROM teacherdb WHERE Id = '$id'");
            				$Name = mysql_fetch_array($Nam);*/
            				header("Location:../student/mbxz.html");
							$_SESSION["login"]["id"]=$id;
                            $_SESSION["typeid"]=$typeid;
            			}else{
            				echo "<script>alert('密码错误，登录失败！');history.go(-1);</script>";
            			}
            		}
            		break;
            	//管理员
            	case '4':
            		$user = mysql_query("SELECT Id FROM admindb WHERE Id = '$id'");
            		@$user1=mysql_fetch_assoc($user);
            		if(!$user1){
            			echo "<script>alert('用户名不存在！');history.go(-1);</script>";
            		}else{
            			$password = mysql_query("SELECT Password FROM admindb WHERE Id = '$id'");
            			@$password1 = mysql_fetch_array($password);
            			if($Password == $password1['Password']){
            				/*$Nam = mysql_query("SELECT Name FROM admindb WHERE Id = '$id'");
            				$Name = mysql_fetch_array($Nam);*/
            				header("Location:../tjwj/insertime.html");
							$_SESSION["gly"]["id"]=$id;
                            $_SESSION["typeid"]=$typeid;
            			}else{
            				echo "<script>alert('密码错误，登录失败！');history.go(-1);</script>";
            			}
            		}
            		break;        		
            }
			
			break;
		case 'update':
			@$typeid=$_SESSION["typeid"];
			$Password0 = $_POST["Password0"];
            $Password = $_POST["Password"];
            $Password1 = $_POST["Password1"];
            if (empty($Password0)||empty($Password)||empty($Password1)) {
            	echo "<script>alert('请将信息填写完整！');history.go(-1);</script>";
            }else{
				if(empty($typeid)){
					echo "<script>alert('您还没有登录!');window.location.href=\"cleansession.php\";</script>";
					exit;
				}
            	if($Password != $Password1){
					echo "<script>alert('密码不一致！');history.go(-1);</script>";
                }else{
                	switch ($typeid) {
                		//老师
                		case '2':
					       $id=$_SESSION["tch"]["id"];	    
                			$rel = mysql_query("SELECT * FROM teacherdb WHERE Id = '$id'");
                			@$result=mysql_fetch_assoc($rel);
                			if(!$result){
                				echo "<script>alert('用户名不存在！');history.go(-1);</script>";
                			}else{
          				        if($result["Password"]==$Password0){
                					$result1 = mysql_query("UPDATE teacherdb SET Password = '{$Password}' WHERE Id = '$id'" );
                					echo "<script>alert('密码修改成功！');window.location.href=\"cleansession.php\";</script>";
								}else
									echo "<script>alert('旧密码输入错误!');history.go(-1);</script>";
                			}
                			break;
                		//学生
                		case '3':
	                        $id=$_SESSION["login"]["id"];
                			$rel = mysql_query("SELECT * FROM studentdb WHERE Id = '$id'");
                			mysql_query("set names 'GB2312'");
                			@$result=mysql_fetch_assoc($rel);
                			if(!$result){
                				echo "<script>alert('用户名不存在！');history.go(-1);</script>";
								exit;
                			}
							else{
                				if($result["Password"]==$Password0){
                					$result1 = mysql_query("UPDATE studentdb SET Password = '{$Password}' WHERE Id = '$id'" );
                					echo "<script>alert('密码修改成功！');window.location.href=\"cleansession.php\";</script>";
								}
								else
									echo "<script>alert('旧密码输入错误!');history.go(-1);</script>";
							}
                			break;
                		//管理员
                		case '4':
			                $id=$_SESSION["gly"]["id"];
                			$rel = mysql_query("SELECT * FROM admindb WHERE Id = '$id'");
                			@$result=mysql_fetch_assoc($rel);
                			if(!$result){
                				echo "<script>alert('用户名不存在！');history.go(-1);</script>";
                			}else{
                				if($result["Password"]==$Password0){
                					$result1 = mysql_query("UPDATE admindb SET Password = '{$Password}' WHERE Id = '$id'" );
                					echo "<script>alert('密码修改成功！');window.location.href=\"cleansession.php\";</script>";
								}else
									echo "<script>alert('旧密码输入错误!');history.go(-1);</script>";
								}
							break;
                	}
                }
            }
            
			break;		
	}
?>