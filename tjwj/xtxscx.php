<?php
	header("Content-Type: text/html;charset=gb2312");
    session_start();//�����Ự
	if(empty($_SESSION["gly"]["id"])){
        echo "<script>alert('���ȵ�¼');window.location.href=\"../denglu/login.php\";</script>";
		exit;
	}
	include("dbconfig.php");
	$link = mysql_connect(HOST,USER,PASS);
	mysql_select_db(DBNAME,$link);
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
		<?php
			$sql="select sid,pfid from ptable";
			$result1=mysql_query($sql,$link);
			$Page_size=8;
			$count = mysql_num_rows($result1);
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
			$sq="select * from ptable limit ".$offset.",".$Page_size;
			$result=@mysql_query($sq); 
			$page_len = ($page_len%2)?$page_len:$pagelen+1;//ҳ�����
			$pageoffset = ($page_len-1)/2;//ҳ���������ƫ����					
			$key='<div class="page">';
			$key.="<ul class='pagination pagination-sm'><li><span>$page/$pages</span></li> "; //�ڼ�ҳ,����ҳ
			if($page!=1){
				$key.="<li><a onclick=\"show1(1)\" style='cursor: pointer;'>��һҳ</a></li> "; //��һҳ
				$key.="<li><a onclick=\"show1(".($page-1).")\" style='cursor: pointer;'>��һҳ</a></li>"; //��һҳ
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
					$key.=" <li><a onclick='show1(".$i.")' style='cursor: pointer;'>".$i."</a></li>";
			}
			if($page!=$pages){
				$key.=" <li><a onclick=\"show1(".($page+1).")\" style='cursor: pointer;'>��һҳ</a></li> ";//��һҳ
				$key.="<li><a onclick=\"show1(".$pages.")\" style='cursor: pointer;'>���һҳ</a></li>"; //���һҳ
			}else {
				$key.="<li class='disabled'><a>��һҳ</a></li>";//��һҳ
				$key.="<li class='disabled'><a>���һҳ</a></li>"; //���һҳ
			}
			$key.='</ul></div>';
			echo "<table class='table table-striped table-bordered table-hover' style='width: 70%;margin-top: 15px;position:relative;left:0px; '>";	
			echo "<tr>
					<td><strong>ѧ��ѧ��</strong></td>
					<td><strong>ѧ������</strong></td>
					<td><strong>ѡ����</strong></td>
					<td><strong>ָ����ʦ</strong></td>
				</tr>";
			while($row1=@mysql_fetch_assoc($result)){
				$id=$row1['sid'];
				$pfid=$row1['pfid'];	

				$sql="select studentdb.Name as sname,ptitle,tid,teacherdb.Name as tname from ttable,studentdb,teacherdb where pid='".$pfid."' and studentdb.Id='".$id."' and ttable.tid=teacherdb.Id";
				$querysql=mysql_query($sql);
				$resultsql=mysql_fetch_array($querysql);
				
				$sname=$resultsql["sname"];
				$tname=$resultsql["tname"];
				$ptitle=$resultsql["ptitle"];
				
				if(empty($pfid)){
					$sqlsname="select Name from studentdb where Id=".$id."";
					$dosql=mysql_query($sqlsname);
					$rowsql=@mysql_fetch_array($dosql);
					$sname=$rowsql["Name"];
					$tname="��ѧ������ѡ��";
					$ptitle="��ѧ������ѡ��";
				}
				
				echo "<tr>";
				echo "<td>".$id."</td>";	
				echo "<td>".$sname."</td>";
				echo "<td>".$ptitle."</td>"; 
				echo "<td>".$tname."</td>";
				echo "</tr>";
			}
			echo "</table>";
		?>
		<div align="center" style="position:absolute;top:550px;left:450px;"><?php echo $key?></div>
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>