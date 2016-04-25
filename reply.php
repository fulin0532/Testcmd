<?php
/**
 * Created by PhpStorm.
 * User: zhangfulin
 * Date: 16/4/18
 * Time: 下午10:14
 */
session_start();
if (!$_SESSION['admin']) {
    return false;
}
require_once ('message.php');
$id = $_POST['id'];
$reply = $_POST['reply'];
$replytime=time();
//!(empty($id) || empty($reply)) <=> (!empty($id) && !empty($reply))
if (!(empty($id) || empty($reply))) {
    $conn=db_connection();
    $reply_sql = 'UPDATE ' . GB_TABLE_NAME . '
                    SET reply = ' . $reply .
                    ' and replytime='.$replytime.'
                    WHERE id = ' . $id;
    $result=$conn->query($reply_sql);
    if ($result) {
        echo '{"error":0, "msg":"reply success"}';
    } else {
        echo '{"error":1, "msg":"reply error"}';
    }
} else {
    echo '{"error":1, "msg":"id or reply not null"}';
}