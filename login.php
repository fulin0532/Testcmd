<?php
/**
 * Created by PhpStorm.
 * User: zhangfulin
 * Date: 16/4/18
 * Time: 下午9:18
 */
/////为什么差中文匹配不到
require_once ('message.php');
$user = $_POST['uname'];
$pwd = $_POST['password'];
echo gettype($pwd);
$sql_login = 'SELECT pwd FROM ' . ADMIN_TABLE_NAME . ' 
                WHERE   nickname = '. "'{$user}'";
$sql_login1="select pwd from user where nickname='".$user."'";
echo $sql_login1;
$conn=db_connection();
$result=$conn->query($sql_login1);
echo count($result);
if(!$result){
    echo "木查到你的数据!!!";
}else{
//    echo $result->fetch_row()[0];
//    $row=$result->fetch_row()[0];
    $row=$result->fetch_assoc();
    $password = $row;
    echo "假的".$row['pwd']."?||||||";
    $conn->close();
    if ($pwd ===$password) {
        //save to session
        session_start();
        $_SESSION['admin'] = true;
        header('location:admin.php');
    } else {
        echo "假的,傻逼";
//    header('location:index.html');
    }
}
