<?php
    header("Content-Type: text/html;charset=gb2312");
	session_start();
	include("dbconfig.php");
    $con = mysql_connect(HOST,USER,PSW);
    mysql_select_db(dbname,$con);
    mysql_query("set names 'GB2312'");
	if(empty($_SESSION["login"]["id"])){
        echo "<script>alert('���ȵ�¼');window.location.href=\"../denglu/login.php\";</script>";
		exit;
	}
?>
<!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>��ҵ������ϵͳ</title>
		<style>
			#ftable tr td{
				padding-top:25px;
				padding-bottom:25px;
			}
		</style>
	</head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link type="text/css" href="css/index.css" rel="stylesheet" />
	<script type="text/javascript" src="js/index.js"></script>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript">
		var checktime=function(){		    
			$.ajax({
			    type:"GET",
			    url:"dealwithmessage.php", 
			    dataType:'json',
			    success:update_page1
			});
		}
		function update_page1(json){
		    var str="";
			if(json[2]==0)
				str="(�ѽ�ֹ)";
			else if(json[2]==1)
				str="(������)";
			else if(json[2]==2)
				str="(δ��ʼ)";
			$('#j').html(str);
			for(var i=5;i<14;i++){
				if(json[i]==0)
				  str="(�ѽ�ֹ)";
				else if(json[i]==1)
					str="(������)";
				else if(json[i]==2)
					str="(δ��ʼ)";
				if(i==5)
					$('#a').html(str);
				else if(i==6)
					$('#b').html(str);
				else if(i==7)
					$('#c').html(str);
				else if(i==8)
					$('#d').html(str);
				else if(i==9)
					$('#e').html(str);
				else if(i==10)
					$('#f').html(str);
				else if(i==11)
					$('#g').html(str);
				else if(i==12)
					$('#h').html(str);
				else if(i==13)
					$('#i').html(str);
			}
		}
		function timeset(){
			checktime();
			setInterval('checktime()',10000);
		}
		function setSecond1(){
			$.ajax({
				type:"GET",
				url:"tbzy_ht.php?action=kt",
				data:{tidfirst:$("#first1").val()},
				dataType:'json',
				success:update1
			});
		}
		function update1(json){
			var ktstr="";
			ktstr+="<select name=\"pid1\" class=\"selectpicker show-tick form-control\" style=\"width:200px;\">";
			ktstr+="<option value=''>��ѡ�����</option>";
			for (var i = 0; json[i]; i++) {
				var pidx=json[i]["pid"];
				ktstr+="<option value="+pidx+">" +json[i]["ptitle"]+ "</option>";	
			}
			if(i==0){
				ktstr+="<option value=''>�޿���</option>";
			}
			ktstr+="</select>";
			$("#second1").html(ktstr);
			var obj = document.getElementById("btnB");
			obj.style.cssText = "padding-left:215px;";
		}

		function setSecond2(){
			$.ajax({
			  type:"GET",
			  url:"tbzy_ht.php?action=kt",
			  data:{tidfirst:$("#first2").val()},
			  dataType:'json',
			  success:update2
			});
		}
		function update2(json){
			var ktstr2="";
			ktstr2+="<select name=\"pid2\" class=\"selectpicker show-tick form-control\" style=\"width:200px;\">";
			ktstr2+="<option value=''>��ѡ�����</option>";
			for (var j = 0; json[j]; j++) {
				var pidy=json[j]["pid"];
				ktstr2+="<option value="+pidy+">" + json[j]["ptitle"] + "</option>";	
			}
			if(j==0){
				ktstr2+="<option value=''>�޿���</option>";
			}
			ktstr2+="</select>";
			$("#second2").html(ktstr2);
			var obj = document.getElementById("btnB");
			obj.style.cssText = "padding-left:215px;";
		}
		function checkxt(){
			var xt1=document.getElementById("pid1");
			var xt2=document.getElementById("pid2");
			
			if(window.confirm("ȷ��Ҫ�ύ��")){
				if(xt1.value==""||xt2.value==""){
					alert("�������");
					return false;
				}
				if(xt1.value==xt2.value){
					alert("����־Ը������ͬ"+xt1.value+"AA"+xt2.value);
					return false;
					
				}else{
					return true;
				}
			}else{
				return false;
			}
			
		}
	</script>
	<body onload="timeset()">
		<div style="background-color: #F0F0F0;height: 90px;">
			<table>
				<tr>
					<td>
						<img src="img/jhlogo.jpg"/>
					</td>
					<td valign="middle">
						<h1 style="margin-left: 400px;">�־Ը</h1>
					</td>
				</tr>
			</table>
			<ul class="nav nav-tabs" style="width: 20%;float: right;margin-top:-32px;">
				<li><a href="../denglu/update.php">�޸�����</a></li>
				<li><a href="../denglu/cleansession.php">�˳�ϵͳ</a></li>
		</div>
		<div>
			<div style="width: 18%;float:left;">
				<ul class="nav nav-tabs nav-stacked">
					<li onmouseover="Seover(this)" onmouseout="Seout(this)"><a>��ҵ���ѡ��<span class="caret"></span></a>
						<ul class="nav nav-tabs nav-stacked">
							<li><a href="xtck.php">�鿴ѡ��</a></li>
							<li><a href="../tjwj/sjpd.php?taskid=2">�ѡ��־Ը<font id="j"></font></a></li>
						</ul>
					</li>
					<li onmouseover="Seover(this)" onmouseout="Seout(this)"><a>ѡ�����񻷽�<span class="caret"></span></a>
						<ul class="nav nav-tabs nav-stacked">
							<li><a href="../tjwj/sjpd.php?taskid=5">������<font id="a"></font></a></li>
							<li><a href="../tjwj/sjpd.php?taskid=6">���ⱨ��<font id="b"></font></a></li>
							<li><a href="../tjwj/sjpd.php?taskid=7">��������<font id="c"></font></a></li>
							<li><a href="../tjwj/sjpd.php?taskid=8">���ķ���<font id="d"></font></a></li>
							<li><a href="../tjwj/sjpd.php?taskid=9">���ڼ���<font id="e"></font></a></li>
							<li><a href="../tjwj/sjpd.php?taskid=10">��ҵ���ĵ�һ��<font id="f"></font></a></li>
							<li><a href="../tjwj/sjpd.php?taskid=11">��ҵ���ĵڶ���<font id="g"></font></a></li>
							<li><a href="../tjwj/sjpd.php?taskid=12">��ҵ���ĵ�����<font id="h"></font></a></li>
							<li><a href="../tjwj/sjpd.php?taskid=13">����<font id="i"></font></a></li>
						</ul>
					</li>
					<li onmouseover="Seover(this)" onmouseout="Seout(this)"><a>����ѡ��<span class="caret"></span></a>
						<ul class="nav nav-tabs nav-stacked">
							<li><a href="mbxz.html">ģ������</a></li>
						</ul>
					</li>
					<li onmouseover="Seover(this)" onmouseout="Seout(this)"><a>�鿴���<span class="caret"></span></a>
						<ul class="nav nav-tabs nav-stacked">
							<li><a href="result.php">�鿴ѡ����</a></li>
							<li><a href="teacherbrief.php">ָ����ʦ����</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<div style="width: 82%;float:right;">
				<form action="tbzy_ht.php?action=submit" method="post" style="position:relative;top:50px;">
					<table style="width:60%;height:50%;position:relative;left:150px;top:-10px;" border="0" id="ftable">
					<tr>
						<td style="width:100px;"><strong>־Ըһ��</strong></td>
						<td style="width:150px;">
						<select id="first1" onchange="setSecond1()" class="selectpicker show-tick form-control" style="width:150px;">
							<option value="">--��ѡ����ʦ--</option>
							<?php
							$sql=mysql_query("select * from teacherdb");
							while ($row=mysql_fetch_assoc($sql)) {
								$id=$row["Id"];
								echo "<option value=".$id.">".$row["Name"]."</option>";
							}
							?>
						</select>
						</td>
						<td id="second1" style="width:300px;">
						</td>
					<tr>
						<td><strong>־Ը����</strong></td>
						<td>
						<select id="first2" onchange="setSecond2()" class="selectpicker show-tick form-control" style="width: 150px;">
							<option value="">--��ѡ����ʦ--</option>
							<?php
							$con = mysql_connect(HOST,USER,PSW);
							mysql_select_db(dbname,$con);
							mysql_query("set names 'GB2312'");
							$sql=mysql_query("select * from teacherdb");
							while ($row=mysql_fetch_assoc($sql)) {
								$id=$row["Id"];
								echo "<option value=".$id.">".$row["Name"]."</option>";
							}
							?>
						</select>
						</td>
						<td id="second2">
						</td>
					</tr>
					<tr>
						<td id="btnB" colspan="3" style="padding-left:120px;">
						<button type="submit" onClick="return checkxt()" class="btn btn-primary" style="width:150px;">�ύ</button>
						</td>
					</tr>
					</table>
				</form>
			</div>
		</div>
	</body>

</html>