<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>学生信息管理系统</title>
</head>
<body>
<center>
  <?php include ('menu.php');
	$dsn = 'mysql:dbname=mysqlPdo;host=127.0.0.1';
    $user = 'root';
    $password = 'Html5Web';
//    1. 链接数据库
    try{
      $pdo = new PDO($dsn, $user, $password);
  }catch (PDOException $e) {
    die('connection failed'.$e->getMessage());
  }
  //2.执行sql
  $sql_select = "select * from stu where id={$_GET['id']}";
  $stmt = $pdo->query($sql_select);
  if ($stmt->rowCount() >0) {
    $stu = $stmt->fetch(PDO::FETCH_ASSOC); // 解析数据
  }else{
    die("no have this id:{$_GET['id']}");
  }
  ?>
   
  <h3>修改学生信息</h3>
 
  <form action="action.php?action=edit" method="post">
    <input type="hidden" name="id" value="<?php echo $stu['id'];?>">
    <table>
      <tr>
        <td>姓名</td>
        <td><input type="text" name="name" value="<?php echo $stu['name'];?>"></td>
      </tr>
      <tr>
        <td>年龄</td>
        <td><input type="text" name="age" value="<?php echo $stu['age'];?>"></td>
      </tr>
      <tr>
        <td>性别</td>
        <td>
          <input type="radio" name="sex" value="男" <?php echo ($stu['sex'] == "男")? "checked":"";?> >男
        </td>
        <td>
          <input type="radio" name="sex" value="女" <?php echo ($stu['sex'] == "女")? "checked":"";?> >女
        </td>
      </tr>
      <tr>
        <td>班级</td>
        <td><input type="text" name="classid" value="<?php echo $stu['classid']?>"></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" value="更新"></td>
        <td><input type="reset" value="重置"></td>
      </tr>
    </table>
  </form>
   
   
</center>
 
<?php
?>
</body>
</html>