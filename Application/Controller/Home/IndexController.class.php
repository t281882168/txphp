<?php

// application/controllers/Home/IndexController.class.php


class IndexController extends Controller{
    public function MainAction(){

        include CURR_VIEW_PATH . "main.html";

        // Load Captcha class

        $this->loader->library("Captcha");

        $captcha = new Captcha;

        $captcha->hello();

        $userModel = new UserModel("user");

        $users = $userModel->getUsers();

    }

    public function IndexAction(){
        fileContent('ABC',C('SQL_LOG'));exit;
      $userModel = new UserModel("user");
    //  var_dump($userModel);

      $users = $userModel->getUsers();

        // Load View template
     //   dump(C());
       
     //   include  CURR_VIEW_PATH . "index.html";
        var_dump($users);exit;

    }

    public function MenuAction(){

        include CURR_VIEW_PATH . "menu.html";

    }

    public function DragAction(){

        include CURR_VIEW_PATH . "drag.html";

    }

    public function TopAction(){

        include CURR_VIEW_PATH . "top.html";

    }

}