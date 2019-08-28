<?php
	header("Content-Type: text/html;charset=gb2312");
    session_start();//开启会话
	if(empty($_SESSION["login"]["id"])){
        echo "<script>alert('请先登录');window.location.href=\"../denglu/login.php\";</script>";
		exit;
	}
	include("dbconfig.php");
	$con = mysql_connect(HOST,USER,PSW);
	mysql_select_db(dbname,$con);
	mysql_query("set names 'GB2312'");
?>
<!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>毕业生管理系统</title>
		<style>
			table tr td{
				text-align:center;
				height:30px;
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
					str="(已截止)";
				else if(json[2]==1)
					str="(进行中)";
				else if(json[2]==2)
					str="(未开始)";
				$('#j').html(str);
				for(var i=5;i<14;i++){
					if(json[i]==0)
					  str="(已截止)";
					else if(json[i]==1)
						str="(进行中)";
					else if(json[i]==2)
						str="(未开始)";
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
		</script>
	<body onload="timeset()">
		<div style="background-color: #F0F0F0;height: 90px;">
			<table>
				<tr>
					<td>
						<img src="img/jhlogo.jpg"/>
					</td>
					<td valign="middle">
						<h1 style="margin-left: 400px;">查看选题</h1>
					</td>
				</tr>
			</table>
			<ul class="nav nav-tabs" style="width: 20%;float: right;margin-top:-32px;">
				<li><a href="../denglu/update.php">修改密码</a></li>
				<li><a href="../denglu/cleansession.php">退出系统</a></li>
		</div>
		<div>
			<div style="width: 18%;float:left;">
				<ul class="nav nav-tabs nav-stacked">
					<li onmouseover="Seover(this)" onmouseout="Seout(this)"><a>毕业设计选题<span class="caret"></span></a>
						<ul class="nav nav-tabs nav-stacked">
							<li><a href="xtck.php">查看选题</a></li>
							<li><a href="../tjwj/sjpd.php?taskid=2">填报选题志愿<font id="j"></font></a></li>
						</ul>
					</li>
					<li onmouseover="Seover(this)" onmouseout="Seout(this)"><a>选择任务环节<span class="caret"></span></a>
						<ul class="nav nav-tabs nav-stacked">
							<li><a href="../tjwj/sjpd.php?taskid=5">任务书<font id="a"></font></a></li>
							<li><a href="../tjwj/sjpd.php?taskid=6">开题报告<font id="b"></font></a></li>
							<li><a href="../tjwj/sjpd.php?taskid=7">文献综述<font id="c"></font></a></li>
							<li><a href="../tjwj/sjpd.php?taskid=8">外文翻译<font id="d"></font></a></li>
							<li><a href="../tjwj/sjpd.php?taskid=9">中期检查表<font id="e"></font></a></li>
							<li><a href="../tjwj/sjpd.php?taskid=10">毕业论文第一版<font id="f"></font></a></li>
							<li><a href="../tjwj/sjpd.php?taskid=11">毕业论文第二版<font id="g"></font></a></li>
							<li><a href="../tjwj/sjpd.php?taskid=12">毕业论文第三版<font id="h"></font></a></li>
							<li><a href="../tjwj/sjpd.php?taskid=13">其它<font id="i"></font></a></li>
						</ul>
					</li>
					<li onmouseover="Seover(this)" onmouseout="Seout(this)"><a>功能选项<span class="caret"></span></a>
						<ul class="nav nav-tabs nav-stacked">
							<li><a href="mbxz.html">模板下载</a></li>
						</ul>
					</li>
					<li onmouseover="Seover(this)" onmouseout="Seout(this)"><a>查看结果<span class="caret"></span></a>
						<ul class="nav nav-tabs nav-stacked">
							<li><a href="result.php">查看选题结果</a></li>
							<li><a href="teacherbrief.php">指导老师评语</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<div style="width: 82%;float:right;">
				<table class="table table-striped table-bordered table-hover" style="width:80%;margin-top: -60px;position:relative;left:100px;">
					<tr>
						<td align="center" style='width:49%;'><strong>题目</strong></td>
						<td align="center" style='width:17%;'><strong>老师姓名</strong></td>
						<td align="center" style='width:17%;'><strong>报名人数/人数上限</strong></td>
						<td align="center" style='width:17%;'><strong>具体信息</strong></td>
					</tr>
				    <?php
						$Page_size=8;
						$result=@mysql_query('select * from ttable');
						$count = mysql_num_rows($result);
						$page_count = ceil($count/$Page_size);
						$init=1;
						$page_len=5;
						$max_p=$page_count;
						$pages=$page_count;
						if(empty($_GET['page'])||$_GET['page']<0)
							$page=1;
						else
							@$page=$_GET['page'];
						$offset=$Page_size*($page-1);
						$sql="select * from ttable limit ".$offset.",".$Page_size;
						$result=@mysql_query($sql); 
						$page_len = ($page_len%2)?$page_len:$pagelen+1;//页码个数
						$pageoffset = ($page_len-1)/2;//页码个数左右偏移量
						function change($a)
						{
							$sql1=@mysql_query("select Name from teacherdb where Id=$a");
							$tname=@mysql_fetch_assoc($sql1);
							return $tname["Name"];
						}
						function num($b)
						{
							$sql2=@mysql_query("select count(*) from ptable where pid1=$b group by pid1");
							$count=@mysql_fetch_assoc($sql2);
							if(empty($count["count(*)"]))
							$count["count(*)"]=0;
							return $count["count(*)"];
						}
						while($row=@mysql_fetch_assoc($result))
						{
							echo "<tr>";
							echo "<form method='POST' action='ckxt.php'>";
							echo "<td align='center'>".$row["ptitle"]."</td>";
							$x=change($row['tid']);
							echo "<td align='center'>".$x."</td>";
							$y=num($row['pid']);
							echo "<td align='center'>".$y."/".$row["ppnum"]."</td>";
							echo "<input type='hidden' value=".$row['tid']." name='tid'><input type='hidden' value=".$row['pid']." name='pid'>";
							echo "<td align=\"center\" style='padding: 5px 0;'>";
							echo "<input type='submit' value='查看' class=\"btn btn-primary\" style='margin:0;'>";
							echo "</td>";
							echo "</form>";
							echo "</tr>";
						}
						
						$key='<div class="page">';
						$key.="<ul class='pagination pagination-sm'><li><span>$page/$pages</span></li> "; //第几页,共几页
						if($page!=1){
							$key.="<li><a href=\"".$_SERVER['PHP_SELF']."?page=1\">第一页</a></li> "; //第一页
							$key.="<li><a href=\"".$_SERVER['PHP_SELF']."?page=".($page-1)."\">上一页</a></li>"; //上一页
						}else {
							$key.="<li class='disabled'><a>第一页</a></li>";//第一页
							$key.="<li class='disabled'><a>上一页</a></li>"; //上一页
						}
						if($pages>$page_len){
						//如果当前页小于等于左偏移
						if($page<=$pageoffset){
						$init=1;
						$max_p = $page_len;
						}else{//如果当前页大于左偏移
						//如果当前页码右偏移超出最大分页数
							if($page+$pageoffset>=$pages+1){
							$init = $pages-$page_len+1;
							}else{
						//左右偏移都存在时的计算
								$init = $page-$pageoffset;
								$max_p = $page+$pageoffset;
							}
						}
						}
						for($i=$init;$i<=$max_p;$i++){
						if($i==$page){
						$key.="<li class='active'><span>$i</span></li>";
						}else {
							$key.=" <li><a href=\"".$_SERVER['PHP_SELF']."?page=".$i."\">".$i."</a></li>";
						}
						}
						if($page!=$pages){
							$key.=" <li><a href=\"".$_SERVER['PHP_SELF']."?page=".($page+1)."\">下一页</a></li> ";//下一页
							$key.="<li><a href=\"".$_SERVER['PHP_SELF']."?page={$pages}\">最后一页</a></li>"; //最后一页
						}else {
							$key.="<li class='disabled'><a>下一页</a></li>";//下一页
							$key.="<li class='disabled'><a>最后一页</a></li>"; //最后一页
						}
						$key.='</ul></div>';
					?>
					<div align="center" style="position:relative;top:420px;"><?php echo $key?></div>
				</table>
			</div>
		</div>
	</body>

</html>