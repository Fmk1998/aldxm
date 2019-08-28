<?php
	header("Content-Type: text/html;charset=gb2312");
    session_start();//开启会话
	if(empty($_SESSION["gly"]["id"])){
        echo "<script>alert('请先登录');window.location.href=\"../denglu/login.php\";</script>";
		exit;
	}
	include("dbconfig.php");
	$con = mysql_connect(HOST,USER,PASS);
	mysql_select_db(DBNAME,$con);
	mysql_query("set names 'GB2312'");
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
	<body>
		<table class="table table-striped table-bordered table-hover" style="width:70%;margin-top: 15px;position:relative;left:0px;">
			<tr>
				<td style='width:30%;'><strong>课题名</strong></td>
				<td style='width:10%;'><strong>指导老师</strong></td>
				<td style='width:30%;'><strong>学生名</strong></td>	
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
				function teaName($a)
				{
					$sql1=@mysql_query("select Name from teacherdb where Id=$a");
					$tname=@mysql_fetch_assoc($sql1);
					return $tname["Name"];
				}
				function stuName($b)
				{
					$sql2=@mysql_query("select sid from ptable where pfid=$b");
					while($count=@mysql_fetch_array($sql2)){
						$sql3=@mysql_query("select Name from studentdb where Id={$count['sid']}");
						while($stuname=@mysql_fetch_array($sql3))
							return $stuname["Name"];					
					}
				}
				while($row=@mysql_fetch_assoc($result)){				
					echo "<tr>";
					echo "<td>".$row["ptitle"]."</td>";
					$x=teaName($row['tid']);
					echo "<td>".$x."</td>";
					echo "<td>";
					$sql2=@mysql_query("select sid from ptable where pfid={$row['pid']}");
					while($count=@mysql_fetch_array($sql2)){
						$sql3=@mysql_query("select Name from studentdb where Id={$count['sid']}");
						while($stuname=@mysql_fetch_array($sql3)){
							echo $stuname["Name"];
							echo "&nbsp;&nbsp;";
						}
					}
					echo "</td>";
					echo "</tr>";
				}
						
				$key='<div class="page">';
				$key.="<ul class='pagination pagination-sm'><li><span>$page/$pages</span></li> "; //第几页,共几页
				if($page!=1){
					$key.="<li><a onclick=\"show2(1)\" style='cursor: pointer;'>第一页</a></li> "; //第一页
					$key.="<li><a onclick=\"show2(".($page-1).")\" style='cursor: pointer;'>上一页</a></li>"; //上一页
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
						if($page+$pageoffset>=$pages+1)
							$init = $pages-$page_len+1;
						else{
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
						$key.=" <li><a onclick=\"show2(".$i.")\" style='cursor: pointer;'>".$i."</a></li>";
				}
				if($page!=$pages){
					$key.=" <li><a onclick=\"show2(".($page+1).")\" style='cursor: pointer;'>下一页</a></li> ";//下一页
					$key.="<li><a onclick=\"show2(".$pages.")\" style='cursor: pointer;'>最后一页</a></li>"; //最后一页
				}else {
					$key.="<li class='disabled'><a>下一页</a></li>";//下一页
					$key.="<li class='disabled'><a>最后一页</a></li>"; //最后一页
				}
				$key.='</ul></div>';
			?>
			<div align="center"  style="position:absolute;top:550px;left:450px;"><?php echo $key?></div>
		</table>
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>