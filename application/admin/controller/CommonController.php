<?php
/**
 * Created by PhpStorm.
 * User: ZYT
 * Date: 2017/4/10
 * Time: 11:10
 */
namespace app\admin\controller;

use think\Controller;
use think\Request;

class CommonController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_init();
    }

    /**
     * 初始化
     * @return
     */
    public function _init()
    {
        $isLogin = $this->isLogin();
        if(!$isLogin){
            $this->redirect("/admin/login/login");
        }
    }

    /**
     * 判断是否登录
     * @return bool
     */
    public function  isLogin()
    {
        $user = $this->getLoginUer();
        if($user && is_array($user)){
            return true;
        }
        return false;
    }

    /**
     * 获取登录用户信息
     * @return array
     */
    public function getLoginUer()
    {
        return session("user");
    }
}