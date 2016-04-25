<?php
/**
 * Created by PhpStorm.
 * User: zhangfulin
 * Date: 16/4/23
 * Time: 下午4:45
 */
session_start();
session_destroy();
header('location:index.html');