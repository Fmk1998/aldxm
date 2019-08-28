<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>学生信息更改系统</title>
  <script>
    function doDel(id) {
      if(confirm('确认删除?')) {
        window.location='action.php?action=del&id='+id;
      }
    }
  </script>
</head>
<body>
<center>
  <?php
  include ("menu.php");
  ?>
  <h3>查询信息</h3>
  <table width="500" border="1">
    <tr>
      <th>ID</th>
      <th>姓名</th>
      <th>性别</th>
      <th>年龄</th>
      <th>班级</th>
      <th>操作</th>
    </tr>
    <?php
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
    $sql_select = "select * from stu";
    //3.data 解析
    foreach ( $pdo->query($sql_select) as $row) {
      echo "<tr>";
      echo "<th>{$row['id']} </th>";
      echo "<th>{$row["name"]}</th>";
      echo "<th>{$row["sex"]} </th>";
      echo "<th>{$row['age']} </th>";
      echo "<th>{$row['classid']}</th>";
      echo "<td>
          <a href='edit.php?id={$row['id']}'>修改</a>
          <a href='javascript:void(0);' onclick='doDel({$row['id']})'>删除</a>
        </td>";
      echo "</tr>";
    }
    ?>
  </table>
</center>
</body>
</html>