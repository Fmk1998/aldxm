<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>学生信息查询</title>
</head>
<body>
<center>
 
  <?php include ('menu.php'); ?>
  <h3>添加学生信息</h3>
  <form action="action.php?action=add" method="post">
    <table>
      <tr>
        <td>姓名</td>
        <td><input type="text" name="name"></td>
      </tr>
      <tr>
        <td>年龄</td>
        <td><input type="text" name="age"></td>
      </tr>
      <tr>
        <td>性别</td>
        <td><input type="radio" name="sex" value="male">男</td>
        <td><input type="radio" name="sex" value="female">女</td>
      </tr>
      <tr>
        <td>班级</td>
        <td><input type="text" name="classid"></td>
      </tr>
      <tr>
<!--        <td>&nbsp;</td>-->
        <td><a href="index.php">返回</td>
        <td><input type="submit" value="添加"></td>
        <td><input type="reset" value="重置"></td>
      </tr>
    </table> 
  </form>
   
</center>
</body>
</html>