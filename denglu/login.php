<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>登录</title>
<link rel="stylesheet" type="text/css" href="css/style1.css">
<link rel="stylesheet" type="text/css" href="css/body.css"> 
</head>
<body>
<div class="container">
	<section id="content">
		<form action="action.php?action=login" method="post">
			<h1>登&nbsp;&nbsp;&nbsp;&nbsp;录</h1>
			<div>
				<select id="typeid" name="typeid">
					<?php 
					    $typelist=array(1=>"选择类型",2=>"老师",3=>"学生",4=>"管理员");
						foreach($typelist as $k=>$v){
							echo "<option value='{$k}'>{$v}</option>";
						}
					?>
				</select>
			</div>
			<div>
				<input placeholder="输入学号（工号）"  id="id" name="id" type="text">
			</div>
			<div>
				<input placeholder="输入密码"  id="Password" name="Password" type="password">
			</div>
			 <div>
				<span class="help-block u-errormessage" id="js-server-helpinfo">&nbsp;</span>			</div> 
			<div>
				<input value="登录" class="btn btn-primary" id="js-btn-login" type="submit">
			</div>
		</form>
		 <div class="button">
			<span class="help-block u-errormessage" id="js-server-helpinfo">&nbsp;</span>
			
		</div>
	</section>
</div>
</body></html>