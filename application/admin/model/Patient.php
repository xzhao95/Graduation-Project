<?php
/**
 * Created by PhpStorm.
 * User: ZYT
 * Date: 2017/4/12
 * Time: 1:09
 */

namespace app\admin\model;


use think\Db;
use think\Model;

class Patient extends Model
{
    private $_db = '';
    // protected $table = 'think_admin';
    public function __construct()
    {
        $this->_db = Db::table('hms_patient');
        // $this->name = 'admin';
    }

    public function getPatientByUser($userid){
        $ret = $this->_db->where('user_id',$userid)->find();
        return $ret;
    }
}