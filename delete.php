<?php
/**
 * Created by PhpStorm.
 * User: zhangfulin
 * Date: 16/4/18
 * Time: 下午9:58
 */
session_start();
if (!$_SESSION['admin']) {
    return false;
}
require_once ('message.php');
$id = $_POST['id'];
if(isset($_POST['delete1'])) {
//id not empty and is_numeric
    if ((!empty($id) && is_numeric($id))) {
        $delete_sql = 'UPDATE ' . GB_TABLE_NAME . '
                    SET status = 1 WHERE id = ' . $id;
        $conn = db_connection();
        $result = $conn->query($delete_sql);
        if ($result) {
            echo '{"error":0, "msg":"delete success"}';
            echo '<a href=' . 'admin.php>' . '首页</a>';
        } else {
            echo '{"error":1, "msg":"delete falure"}';
            echo '<a href=' . 'admin.php>' . '首页</a>';
        }
    } else {
        echo '{"error":1, "msg":"id needed!"}';
        echo '<a href=' . 'admin.php>' . '首页</a>';
    }
}else{
    $reply = $_POST['reply'];
    $replytime=time();
//!(empty($id) || empty($reply)) <=> (!empty($id) && !empty($reply))
    if (!(empty($id) || empty($reply))) {
        $conn=db_connection();
        $reply_sql = 'UPDATE ' . GB_TABLE_NAME . '
                    SET reply = ' . "'{$reply}'".',replytime='."'{$replytime}'".'
                    WHERE id = ' . $id;
        $conn->query("set names 'utf8'");
        $result=$conn->query($reply_sql);
        echo "回复".$reply_sql;
        if ($result) {
            echo '{"error":0, "msg":"reply success"}';
            header('location:admin.php');
        } else {
            echo '{"error":1, "msg":"reply error"}';
        }
    } else {
        echo '{"error":1, "msg":"id or reply not null"}';
    }
}