<?php
/**
 * Created by PhpStorm.
 * User: zhangfulin
 * Date: 16/4/18
 * Time: 下午5:28
 */
function do_html_header($title)
{
    ?>
    <html>
    <head>
        <title><?php echo $title; ?>
        </title>
    </head>
    <body>
    <h1>Php留言本</h1>
    <hr/>
    </body>
    </html>
    <!--    --><?php //if ($title) {
//    do_html_header($title);

}?>