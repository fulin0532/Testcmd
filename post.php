<!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />-->
<?php
/**
 * Created by PhpStorm.
 * User: zhangfulin
 * Date: 16/4/18
 * Time: 上午11:41
 */

require_once ('message.php');
//header("Content-Type: text/html;charset=utf-8");
$author = $_POST['nickname'];
$content = $_POST['content'];
$email = $_POST['email'];
date_default_timezone_set('PRC');
$create_time = time();
$sql_insert = 'insert into ' . GB_TABLE_NAME . '(nickname, content, createtime, email) 
                values( ' . "'{$author}', '{$content}', {$create_time}, '{$email}')";
echo "插入".$sql_insert;
$conn=db_connection();
///下面的这行代码防止插入中文乱码!!!!!!!!!!!
$conn->query("set names 'utf8'");
$result =$conn->query($sql_insert) ;
if($result) {
    //如果成功
    //redirect to the index page
    header('location:mboard.php');
} else{
    echo '抱歉，留言失败！';
    echo '<a href='.'mboard.php>'.'首页</a>';
}
$conn->close();