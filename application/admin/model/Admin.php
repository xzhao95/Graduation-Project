<?php
/**
 * Created by PhpStorm.
 * User: ZYT
 * Date: 2017/3/17
 * Time: 22:35
 */
namespace app\admin\model;

use think\Db;
use think\Model;


class Admin extends Model {
    private $_db = '';
   // protected $table = 'think_admin';
    public function __construct()
    {
        $this->_db = Db::table('hms_user');
       // $this->name = 'admin';
    }

    public function getAdminByUser($username){
        $ret = $this->_db->where('username',$username)->find();
        return $ret;
    }
}