<?php

// Base Controller
class Controller{
    // Base Controller has a property called $loader, it is an instance of Loader class(introduced later)
    //$this->loader是一个变量指向了被实例化的Load类
    protected $loader;
    public function __construct(){
        $this->loader = new Loader();
    }

    public function redirect($url,$message,$wait = 0){

        if ($wait == 0){

            header("Location:$url");

        } else {

            include CURR_VIEW_PATH . "message.html";

        }


        exit;

    }

}