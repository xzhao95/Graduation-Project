<?php
/**
 * Created by PhpStorm.
 * User: ZYT
 * Date: 2017/3/17
 * Time: 16:12
 */

namespace app\admin\controller;

use app\admin\model\Admin;
use think\Controller;

class Login extends Controller
{
    public function login()
    {
        //$this->assign();
        if(session("user")){
            $this->redirect('/admin/index/index');
        }
        return $this->fetch();
    }

    public function check()
    {
        //print_r($_POST);
        $username = $_POST["username"];
        $password = $_POST["password"];
        if(!trim($username)){
            return show(0,"用户不能为空");
        }
        if(!trim($password)){
            return show(0,"密码不能为空");
        }
        $admin = new Admin;
        $ret = $admin->getAdminByUser($username);
        if(!$ret){
            return show(0,"该用户不存在");
        }
        if($password != $ret["password"]){
            return show(0,"密码不正确");
        }
        session("user",$ret);
        return show(1,"成功登入");
    }

    public function loginout(){
        session("user",null);
        $this->redirect("/admin/login/login");
    }
}