<?php
	header("Content-Type: text/html;charset=gb2312");
    session_start();//�����Ự
	if(empty($_SESSION["gly"]["id"])){
        echo "<script>alert('���ȵ�¼');window.location.href=\"../denglu/login.php\";</script>";
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
		<title>��ҵ������ϵͳ</title>
	</head>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link type="text/css" href="css/index.css" rel="stylesheet" />
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script src="laydate/laydate.js"></script>
	<body>
		<table class="table table-striped table-bordered table-hover" style="width:70%;margin-top: 15px;position:relative;left:0px;">
			<tr>
				<td style='width:30%;'><strong>������</strong></td>
				<td style='width:10%;'><strong>ָ����ʦ</strong></td>
				<td style='width:30%;'><strong>ѧ����</strong></td>	
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
				$page_len = ($page_len%2)?$page_len:$pagelen+1;//ҳ�����
				$pageoffset = ($page_len-1)/2;//ҳ���������ƫ����
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
				$key.="<ul class='pagination pagination-sm'><li><span>$page/$pages</span></li> "; //�ڼ�ҳ,����ҳ
				if($page!=1){
					$key.="<li><a onclick=\"show2(1)\" style='cursor: pointer;'>��һҳ</a></li> "; //��һҳ
					$key.="<li><a onclick=\"show2(".($page-1).")\" style='cursor: pointer;'>��һҳ</a></li>"; //��һҳ
				}else {
					$key.="<li class='disabled'><a>��һҳ</a></li>";//��һҳ
					$key.="<li class='disabled'><a>��һҳ</a></li>"; //��һҳ
				}
				if($pages>$page_len){
				//�����ǰҳС�ڵ�����ƫ��
					if($page<=$pageoffset){
						$init=1;
						$max_p = $page_len;
					}else{//�����ǰҳ������ƫ��
						//�����ǰҳ����ƫ�Ƴ�������ҳ��
						if($page+$pageoffset>=$pages+1)
							$init = $pages-$page_len+1;
						else{
						//����ƫ�ƶ�����ʱ�ļ���
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
					$key.=" <li><a onclick=\"show2(".($page+1).")\" style='cursor: pointer;'>��һҳ</a></li> ";//��һҳ
					$key.="<li><a onclick=\"show2(".$pages.")\" style='cursor: pointer;'>���һҳ</a></li>"; //���һҳ
				}else {
					$key.="<li class='disabled'><a>��һҳ</a></li>";//��һҳ
					$key.="<li class='disabled'><a>���һҳ</a></li>"; //���һҳ
				}
				$key.='</ul></div>';
			?>
			<div align="center"  style="position:absolute;top:550px;left:450px;"><?php echo $key?></div>
		</table>
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>