<?php
/**
 * Created by PhpStorm.
 * User: zhangfulin
 * Date: 16/4/18
 * Time: 下午9:17
 */
session_start();
if (!$_SESSION['admin']) {
    header('location:index.html');
}
$title = 'PHP留言本';
require_once ('message.php');
do_html_header($title);
date_default_timezone_set('PRC');
//分页功能
$gb_count_sql = 'SELECT count(*) FROM ' . GB_TABLE_NAME. ' where status=0';
//echo $gb_count_sql;
//connect db
$conn=db_connection();
$conn->query("set names 'utf8'");
$result=$conn->query($gb_count_sql);
if(!$result){
    echo "查询分页数失败";
}else{
    $gb_count=$result->fetch_row()[0];
}
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
//echo "page".$page."<br />";
//计算留言数，得出分页数
$pagenum = ceil($gb_count / PER_PAGE_GB);
//echo "pagenum".$pagenum."<br />";
if ($page > $pagenum || $page < 0) {
    $page = 1;
}
// 限制搜索结果
$offset = ($page - 1) * PER_PAGE_GB;
$data_sql = 'SELECT  id,nickname,content,email,createtime,reply,replytime 
                  FROM '. GB_TABLE_NAME. ' 
                  WHERE status = 0 ORDER BY createtime DESC LIMIT
                  '.$offset. ',' . PER_PAGE_GB;
//$conn=db_connection();
//echo $data_sql;
$result=$conn->query($data_sql);
//echo "result:".count($result);
$sql_page_array=array();
$count=0;
if(!$result){
    echo "炸了";
}else{
    for($count=1;$row=$result->fetch_assoc();$count++){
        $sql_page_array[$count]=$row;
    }
//    while($temp = $result->fetch_row()) {
//        $sql_page_array[] = $temp;
//    }
}
$conn->close();
//循环输出数据库中满足条件id留言内容
foreach($sql_page_array as $key => $value) {
    echo '<br /><div><form action="delete.php" method="post">';
    echo '<input name="id" type="hidden" value="' . $value['id'] . '" />';
    echo '留言者：'. $value['nickname'].'|';
    echo 'e-mail:' . $value['email'] . '<br />';
    echo '内容:' . $value['content'] . '<br />';
    //将时间转换成指定格式时间
    echo '时间：' . date('Y-m-d H:i:s', $value['createtime']) .'<br />';
    if (!empty($value['reply'])) {
        echo '管理员回复：' . $value['reply'] . '|';
        echo '回复时间：' . date('Y-m-d H:i:s', intval($value['replytime'])) .'<br />';
    } else {
//        echo "<form method='post' action='reply.php'>";
//        echo '<input name="id" type="hidden" value="' . $value['id'] . '" />';
        echo "<input type='text' placeholder='请回复' name='reply'>";
        echo '<input type="submit" name="reply1" value="reply"/>';
//        echo "</form>";
    }
    echo '<input type="submit" name="delete1" value="delete"/></div>';
    echo '</form><hr />';
}

echo '共 '.$gb_count.'&nbsp;&nbsp;条留言  ';
if ($pagenum > 1) {
    for($i = 1; $i <= $pagenum; $i++) {
        if($i == $page) {
            echo '&nbsp;&nbsp;['.$i.']';
        } else {
            echo '<a href="?page='. $i .'">&nbsp;' . $i . '&nbsp;</a>';
        }
    }
}
echo "<br /><a href='logout.php'>Logout</a>";