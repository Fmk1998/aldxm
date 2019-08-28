<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312">
<title>修改密码</title>
<link rel="stylesheet" type="text/css" href="css/style1.css">
<link rel="stylesheet" type="text/css" href="css/body.css"> 
</head>
<body>
<div class="container">
	<section id="content">
		<form action="action.php?action=update" method="post">
			<h1>修&nbsp;改&nbsp;密&nbsp;码</h1>
			
			<div>
				<input placeholder="输入旧密码"  id="Password0" name="Password0" type="password">
			</div>
			<div>
				<input placeholder="新密码"  id="Password" name="Password" type="password">
			</div>
			<div>
				<input placeholder="确认新密码"  id="Password1" name="Password1" type="password">
			</div>
			 <div>
				<span class="help-block u-errormessage" id="js-server-helpinfo">&nbsp;</span>			</div> 
			<!--div>
                <a href="login.php">
					<input value="登录" class="btn btn-primary" id="js-btn-login" type="button">
				</a>
			</div-->
			<div>
				<input value="确认" class="btn btn-primary" id="js-btn-login" type="submit">
			</div>
			
		</form>
		 <div class="button">
			<span class="help-block u-errormessage" id="js-server-helpinfo">&nbsp;</span>
			
		</div>
	</section>
</div>
</body></html>