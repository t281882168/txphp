<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Loader
 *
 * @author Tianxin
 * 加载类
 * 现在我们可以新建一个Loader类，它会加载framework目录中的类和函数。当我们加载framework类时，只需要调用这个Loader类中的方法即可
 */

class Loader{

    // Load library classes

    public function library($lib){

        include LIB_PATH . "$lib.class.php";

    }


    // loader helper functions. Naming conversion is xxx_helper.php;

    public function helper($helper){

        include HELPER_PATH . "{$helper}_helper.php";

    }

}