<?php
	header("Content-Type: text/html;charset=gb2312");
    session_start();//�����Ự
	if(empty($_SESSION["login"]["id"])){
        echo "<script>alert('���ȵ�¼');window.location.href=\"../denglu/login.php\";</script>";
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
		<title>��ҵ������ϵͳ</title>
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
		</script>
	<body onload="timeset()">
		<div style="background-color: #F0F0F0;height: 90px;">
			<table>
				<tr>
					<td>
						<img src="img/jhlogo.jpg"/>
					</td>
					<td valign="middle">
						<h1 style="margin-left: 400px;">�鿴ѡ��</h1>
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
				<table class="table table-striped table-bordered table-hover" style="width:80%;margin-top: -60px;position:relative;left:100px;">
					<tr>
						<td align="center" style='width:49%;'><strong>��Ŀ</strong></td>
						<td align="center" style='width:17%;'><strong>��ʦ����</strong></td>
						<td align="center" style='width:17%;'><strong>��������/��������</strong></td>
						<td align="center" style='width:17%;'><strong>������Ϣ</strong></td>
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
							echo "<input type='submit' value='�鿴' class=\"btn btn-primary\" style='margin:0;'>";
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
						if($i==$page){
						$key.="<li class='active'><span>$i</span></li>";
						}else {
							$key.=" <li><a href=\"".$_SERVER['PHP_SELF']."?page=".$i."\">".$i."</a></li>";
						}
						}
						if($page!=$pages){
							$key.=" <li><a href=\"".$_SERVER['PHP_SELF']."?page=".($page+1)."\">��һҳ</a></li> ";//��һҳ
							$key.="<li><a href=\"".$_SERVER['PHP_SELF']."?page={$pages}\">���һҳ</a></li>"; //���һҳ
						}else {
							$key.="<li class='disabled'><a>��һҳ</a></li>";//��һҳ
							$key.="<li class='disabled'><a>���һҳ</a></li>"; //���һҳ
						}
						$key.='</ul></div>';
					?>
					<div align="center" style="position:relative;top:420px;"><?php echo $key?></div>
				</table>
			</div>
		</div>
	</body>

</html>