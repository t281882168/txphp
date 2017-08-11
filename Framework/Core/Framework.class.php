<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// framework/core/Framework.class.php
class Framework {
   public static function run() {
//        echo "run()";
       self::init();        //加载参数
      // self::libraries();   //默认加载 第三方类及 函数库文件
       self::functions();   //默认加载  函数库文件
       self::autoload();    //自动加载控制器和文件
       self::dispatch();    //初始化方法

   }

   //初始化
   private static function init() {
    // 记录开始运行时间
    $GLOBALS['_beginTime'] = microtime(TRUE);
    // 记录内存初始使用
    define('MEMORY_LIMIT_ON',function_exists('memory_get_usage'));
    if(MEMORY_LIMIT_ON) $GLOBALS['_startUseMems'] = memory_get_usage();

    define("DS", DIRECTORY_SEPARATOR);                      //  linux 为/  window 下为\
    define("ROOT", getcwd() . DS);                          //当前根目录
    define("APP_PATH", ROOT . 'Application' . DS);          //项目所在目录
    define("FRAMEWORK_PATH", ROOT . "Framework" . DS);      //框架所在目录
    define("FUNCTION_PATH", FRAMEWORK_PATH . "Functions" . DS); //默认函数库所在目录
    define("PUBLIC_PATH", ROOT . "Public" . DS);            //Html公用文件
    define("CONFIG_PATH", APP_PATH . "Config" . DS);        //配置文件
    define("CONTROLLER_PATH", APP_PATH . "Controller" . DS);   //控制器所在目录
    define("MODEL_PATH", APP_PATH . "Model" . DS);         //模型所在目录
    define("VIEW_PATH", APP_PATH . "View" . DS);             //视图所在目录
    define("RUNTIME", APP_PATH . "Runtime" . DS);           //临时文件所在目录


    define("CORE_PATH", FRAMEWORK_PATH . "Core" . DS);      //核心库
    define('DB_PATH', FRAMEWORK_PATH . "Database" . DS);
    define("LIB_PATH", FRAMEWORK_PATH . "Libraries" . DS);
    define("HELPER_PATH", FRAMEWORK_PATH . "Helpers" . DS);
    define("UPLOAD_PATH", PUBLIC_PATH . "Uploads" . DS);    

    // Define platform, controller, action, for example:
    // index.php?g=admin&c=Goods&a=add

    define("PLATFORM", isset($_REQUEST['g']) ? $_REQUEST['g'] : 'Home');
    define("CONTROLLER", isset($_REQUEST['c']) ? $_REQUEST['c'] : 'Index');
    define("ACTION", isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index');
    define("CURR_CONTROLLER_PATH", CONTROLLER_PATH . PLATFORM . DS);
    define("CURR_VIEW_PATH", VIEW_PATH . PLATFORM . DS);
    define("LOGS", RUNTIME.'log.txt');
    //''=>'logs.txt',   默认日志文件名
    // Load core classes
    require CORE_PATH . "Controller.class.php";
    require CORE_PATH . "Loader.class.php";
    require DB_PATH . "Mysql.class.php";
    require CORE_PATH . "Model.class.php";

    // Load configuration file
    $GLOBALS['config']= include CONFIG_PATH . "Config.php";    //加载配置文件
   // var_dump($GLOBALS['config']);
  //  static $_config =array($GLOBALS['config']);
    // Start session
    session_start();
}

  // Autoloading
    /*自动加载类*/
    private static function autoload(){
        spl_autoload_register(array(__CLASS__,'load'));

    }
    
    // Define a custom load method
    /*加载类库*/
    private static function load($classname){
        // Here simply autoload app&rsquo;s controller and model classes
          //  var_dump(__CLASS__);
        if (substr($classname, -10) == "Controller"){
            // Controller
           //var_dump(CURR_CONTROLLER_PATH . $classname.'.class.php');
            require_once CURR_CONTROLLER_PATH . $classname.'.class.php';
        } elseif (substr($classname, -5) == "Model"){
            // Model
           // var_dump( MODEL_PATH . $classname.'.class.php');
            require_once  MODEL_PATH . $classname.'.class.php';
        }
    }

    //路由/分发 //在这步中，index.php将会分发请求到对应的Controller::Aciton()方法中。
   private static function dispatch(){
        // Instantiate the controller class and call its action method
        $controller_name = CONTROLLER . "Controller";
        $action_name = ACTION . "Action";
        $controller = new $controller_name;
        $controller->$action_name();

    }
    
    //默认加载函数库
    private static function functions(){
         // require_once  MODEL_PATH . $classname.'.class.php';
          include FUNCTION_PATH.DS.'Functions.php';    //加载配置文件
    }

}