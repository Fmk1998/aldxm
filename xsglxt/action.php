<?php
/**
 * Created by PhpStorm.
 * User: hyh
 * Date: 16-7-7
 * Time: 下午9:37
 */
	$dsn = 'mysql:dbname=mysqlPdo;host=127.0.0.1';
    $user = 'root';
    $password = 'root';
//    1. 链接数据库
    try{
      $pdo = new PDO($dsn, $user, $password);
}catch (PDOException $e) {
//      echo 'Connection failed: ' . $e->getMessage();
  die('connection failed'.$e->getMessage());
}
 
//2.action 的值做对操作
 
switch ($_GET['action']){
   
  case 'add'://add 
    $name = $_POST["name"];
    $sex = $_POST["sex"];
    $age = $_POST['age'];
    $classid = $_POST['classid'];
     
    $sql = "insert into stu (name, sex, age, classid) values ('{$name}', '{$sex}','{$age}','{$classid}')";
    $rw = $pdo->exec($sql); 
    if ($rw > 0){
      echo "<script>alter('添加成功');</script>";
    }else{
      echo "<script>alter('添加失败');</script>";
    }
    header('Location: index.php');
    break; 
   
  case 'del'://get
    $id = $_GET['id'];
    $sql = "delete from stu where id={$id}";
    $rw = $pdo->exec($sql);
    if ($rw > 0){
      echo "<script>alter('删除成功');</script>";
    }else{
      echo "<script>alter('删除失败');</script>";
    }
    header('Location: index.php');
    break;
 
  case 'edit'://post
    $id = $_POST['id'];
    $name = $_POST["name"]; 
    $age = $_POST['age'];
    $classid = $_POST['classid'];
    $sex = $_POST["sex"];
     
    $sql = "update stu set name='{$name}', age={$age},sex='{$sex}',classid={$classid} where id=$id;";
    print $sql;
    $rw = $pdo->exec($sql);
    if ($rw > 0){
      echo "<script>alter('更新成功');</script>";
    }else{
      echo "<script>alter('更新失败');</script>";
    }
    header('Location: index.php');
    break; 
   
  default:
    header('Location: index.php');
    break;
}