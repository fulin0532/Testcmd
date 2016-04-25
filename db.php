<?php
/**
 * Created by PhpStorm.
 * User: zhangfulin
 * Date: 16/4/18
 * Time: 上午11:44
 */
require_once ('config.php');
function db_connection(){
    $conn=new mysqli(DB_HOST,DB_USER,DB_PWD,DB_NAME);
    if($conn){
        return $conn;
    }else{
        throw new Exception("链接数据库失败!");
    }
}