<?php
    session_start();
	header("Content-Type: text/html;charset=gb2312");
	if(empty($_SESSION["gly"]["id"])){
		echo "<script>alert('���ȵ�¼');window.location.href=\"../denglu/login.php\";</script>";
		exit;
	}
	$page=@$_GET["page"];
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
			var str="<option value=''>��ѡ����Ŀ</option>";
			for(i=1;json[i];i++){
				str+="<option value="+json[i]["pid"]+">";
				str+=json[i]["ptitle"];
				str+="</option>";
				document.getElementById("submit"+json[0]).disabled=false;
			}
			if(json[1]==0){
				str="<option value=''>������Ŀ�����Ѵ�����</option>";
				document.getElementById("submit"+json[0]).disabled=true;
			}
			$("#pid"+json[0]).html(str);
		}
	</script>
	<body>
		<div style="background-color: #F0F0F0;height: 90px;">
			<img src="img/jhlogo.jpg" />
			<ul class="nav nav-tabs" style="width: 20%;float: right;margin-top: 49px;background-color: #F0F0F0;">
				<li><a href="../denglu/update.php">�޸�����</a></li>
				<li><a href="../denglu/cleansession.php">�˳�ϵͳ</a></li>
			</ul>
		</div>
        <div>
			<div style="width: 18%;float:left;">
				<ul class="nav nav-tabs nav-stacked">
					<li><a href="insertime.html">����ʱ��</a></li>
					<li><a href="timenow.php">�鿴ʱ��</a></li>
					<li><a href="xtzl.php">ѡ������</a></li>
					<li><a href="fpxs.php">����ѡ��ѧ��</a></li>
				</ul>
			</div>
			<div style="width: 80%;float:right;padding-top: 20px;padding-left: 2%;">
				<table class="table table-striped table-bordered table-hover" style="width:90%;">
					<tr>
						<td align="center" width="35%">ѧ��</td>
						<td align="center" width="10%">����</td>
						<td align="center" width="10%">ָ����ʦ</td>
						<td align="center" width="35%">��������</td>
						<td align="center" width="10%">����</td>
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
					$page_len = ($page_len%2)?$page_len:$pagelen+1;//ҳ�����
					$pageoffset = ($page_len-1)/2;//ҳ���������ƫ����
					while($ssqlr=@mysql_fetch_assoc($result))
					{
						echo "<tr>";
						echo "<form action='faction.php' method='post'>";
						echo "<td align=\"center\">".$ssqlr["Id"]."</td>";
						echo "<td align=\"center\">".$ssqlr["Name"]."</td>";
						echo "<td align=\"center\"><select id='tid".$ssqlr["Id"]."' name='tid' onchange='changepid(".$ssqlr["Id"].")'>";
						echo "<option value=''>��ѡ����ʦ</option>";						
						$tsql="select Id,Name from teacherdb";
						$tsqlquery=mysql_query($tsql);
						while($tsqlr=@mysql_fetch_array($tsqlquery))
							echo "<option value=".$tsqlr["Id"].">".$tsqlr["Name"]."</option>";	
						echo "</select></td>";
						echo "<input type='hidden' value=".$ssqlr["Id"]." name='sid'>";
						echo "<input type='hidden' value=".$page." name='page'>";
						echo "<td align=\"center\"><select id='pid".$ssqlr["Id"]."' name='pid' style='width:200px;'><option value=''>��ѡ����Ŀ</option></select></td>";
						echo "<td align=\"center\">";
						echo "<input type='submit' value='�ύ' class=\"btn btn-primary\" style='margin:0;' id=\"submit".$ssqlr["Id"]."\">";
						echo "</td>";
						echo "</form>";
						echo "</tr>";
					}
					$key='<div class="page">';
					$key.="<ul class='pagination pagination-sm'><li><span>$page/$pages</span></li> "; //�ڼ�ҳ,����ҳ
					if($page!=1){
						$key.="<li><a href=\"".$_SERVER['PHP_SELF']."?page=1\">��һҳ</a></li> "; //��һҳ
						$key.="<li><a href=\"".$_SERVER['PHP_SELF']."?page=".($page-1)."\">��һҳ</a></li>"; //��һҳ
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
							if($page+$pageoffset>=$pages+1){
								$init = $pages-$page_len+1;
							}else{
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
							$key.=" <li><a href=\"".$_SERVER['PHP_SELF']."?page=".$i."\">".$i."</a></li>";
						
					}
					if($page!=$pages){
						$key.=" <li><a href=\"".$_SERVER['PHP_SELF']."?page=".($page+1)."\">��һҳ</a></li> ";//��һҳ
						$key.="<li><a href=\"".$_SERVER['PHP_SELF']."?page=".$pages."\">���һҳ</a></li>"; //���һҳ
					}else {
						$key.="<li class='disabled'><a>��һҳ</a></li>";//��һҳ
						$key.="<li class='disabled'><a>���һҳ</a></li>"; //���һҳ
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