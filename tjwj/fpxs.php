<?php
    session_start();
	header("Content-Type: text/html;charset=gb2312");
	if(empty($_SESSION["gly"]["id"])){
		echo "<script>alert('请先登录');window.location.href=\"../denglu/login.php\";</script>";
		exit;
	}
	$page=@$_GET["page"];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<title>毕业生管理系统</title>
	</head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link type="text/css" href="css/index.css" rel="stylesheet" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script src="laydate/laydate.js"></script>
	<style>
		input{
			margin-top:20px;
			margin-bottom:10px;
		}
		select{
			width:150px;
		}
		form{
			margin-top:50px;
		}
		#sinput{
			width:80px;
		}
	</style>
	<script>
		var changepid=function(sid){
			$.ajax({
				type:"GET",
			    url:"getpid.php", 
				data:{tid:$("#tid"+sid).val(),sid:sid},
			    dataType:'json',
			    success:updatepid
			});
		}
		function updatepid(json){
			var i;
			var str="<option value=''>请选择项目</option>";
			for(i=1;json[i];i++){
				str+="<option value="+json[i]["pid"]+">";
				str+=json[i]["ptitle"];
				str+="</option>";
				document.getElementById("submit"+json[0]).disabled=false;
			}
			if(json[1]==0){
				str="<option value=''>所有项目人数已达上限</option>";
				document.getElementById("submit"+json[0]).disabled=true;
			}
			$("#pid"+json[0]).html(str);
		}
	</script>
	<body>
		<div style="background-color: #F0F0F0;height: 90px;">
			<img src="img/jhlogo.jpg" />
			<ul class="nav nav-tabs" style="width: 20%;float: right;margin-top: 49px;background-color: #F0F0F0;">
				<li><a href="../denglu/update.php">修改密码</a></li>
				<li><a href="../denglu/cleansession.php">退出系统</a></li>
			</ul>
		</div>
        <div>
			<div style="width: 18%;float:left;">
				<ul class="nav nav-tabs nav-stacked">
					<li><a href="insertime.html">设置时间</a></li>
					<li><a href="timenow.php">查看时间</a></li>
					<li><a href="xtzl.php">选题总览</a></li>
					<li><a href="fpxs.php">分配选题学生</a></li>
				</ul>
			</div>
			<div style="width: 80%;float:right;padding-top: 20px;padding-left: 2%;">
				<table class="table table-striped table-bordered table-hover" style="width:90%;">
					<tr>
						<td align="center" width="35%">学号</td>
						<td align="center" width="10%">姓名</td>
						<td align="center" width="10%">指导老师</td>
						<td align="center" width="35%">课题名称</td>
						<td align="center" width="10%">操作</td>
					</tr>
				<?php
					include ("dbconfig.php");
					$con=mysql_connect(HOST,USER,PASS);
					mysql_select_db(DBNAME,$con);
					mysql_query("set names 'gb2312'");
					
					/*page*/
					$Page_size=8;
					$result=@mysql_query('select * from studentdb where not exists(select * from ptable where studentdb.Id=ptable.sid and pfid is not null)');
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
					$sql="select Id,Name from studentdb where not exists(select * from ptable where studentdb.Id=ptable.sid and pfid is not null) limit ".$offset.",8";
					$result=@mysql_query($sql); 
					$page_len = ($page_len%2)?$page_len:$pagelen+1;//页码个数
					$pageoffset = ($page_len-1)/2;//页码个数左右偏移量
					while($ssqlr=@mysql_fetch_assoc($result))
					{
						echo "<tr>";
						echo "<form action='faction.php' method='post'>";
						echo "<td align=\"center\">".$ssqlr["Id"]."</td>";
						echo "<td align=\"center\">".$ssqlr["Name"]."</td>";
						echo "<td align=\"center\"><select id='tid".$ssqlr["Id"]."' name='tid' onchange='changepid(".$ssqlr["Id"].")'>";
						echo "<option value=''>请选择老师</option>";						
						$tsql="select Id,Name from teacherdb";
						$tsqlquery=mysql_query($tsql);
						while($tsqlr=@mysql_fetch_array($tsqlquery))
							echo "<option value=".$tsqlr["Id"].">".$tsqlr["Name"]."</option>";	
						echo "</select></td>";
						echo "<input type='hidden' value=".$ssqlr["Id"]." name='sid'>";
						echo "<input type='hidden' value=".$page." name='page'>";
						echo "<td align=\"center\"><select id='pid".$ssqlr["Id"]."' name='pid' style='width:200px;'><option value=''>请选择项目</option></select></td>";
						echo "<td align=\"center\">";
						echo "<input type='submit' value='提交' class=\"btn btn-primary\" style='margin:0;' id=\"submit".$ssqlr["Id"]."\">";
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
						if($i==$page)
							$key.="<li class='active'><span>$i</span></li>";
						else
							$key.=" <li><a href=\"".$_SERVER['PHP_SELF']."?page=".$i."\">".$i."</a></li>";
						
					}
					if($page!=$pages){
						$key.=" <li><a href=\"".$_SERVER['PHP_SELF']."?page=".($page+1)."\">下一页</a></li> ";//下一页
						$key.="<li><a href=\"".$_SERVER['PHP_SELF']."?page=".$pages."\">最后一页</a></li>"; //最后一页
					}else {
						$key.="<li class='disabled'><a>下一页</a></li>";//下一页
						$key.="<li class='disabled'><a>最后一页</a></li>"; //最后一页
					}
					$key.='</ul></div>';
					?>
				</table>
			</div>
			<div style="position:fixed;bottom:10px;padding-left:42%;">
				<?php echo $key?>
			</div>
			
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>