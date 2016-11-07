<?php 

/**
/application-存放web应用程序目录
    /config-存放应用的配置文件
    /controllers-应用的控制器类
    /model-应用的模型类
    /view-应用的视图文件

/TXPHP-存放框架文件目录
    /core-框架核心文件目录
    /database-数据库目录（比如数据库启动类）
    /functions-辅助函数目录
    /libraries-类库目录

/public-存放所有的公共的静态资源，比如HTML文件，CSS文件和jJS文件。
    /css-存放css文件
    /images-存放图片文件
    /js-存放js文件
    /uploads-存放上传的文件
 
index.php-唯一入口文件
 **/

define('APP_DIR',dirname($_SERVER['SCRIPT_NAME']).'/'); 
require "TXPHP/TXPHP.php";
TXPHP::run();
