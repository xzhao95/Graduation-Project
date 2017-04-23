<?php
/**
 * Created by PhpStorm.
 * User: ZYT
 * Date: 2017/4/12
 * Time: 1:09
 */

namespace app\admin\model;


use app\common\model\CommonModel;
use think\Db;
use think\Model;

class Patient extends CommonModel
{
    // private $_db = '';
    // // protected $table = 'think_admin';
    // public function __construct()
    // {
    //     //$this->_db = Db::table('hms_patient');
    //     // $this->name = 'admin';
    // }

    public function getPatientByUser($userid){
        $ret = $this->where('id',$userid)->find()->getData();
        return $ret;
    }

    public function getIsInHospitalAttr($value)
    {
        $isInHospital = [1 => '已住院', 0 => ' '];
        return $isInHospital[$value];
    }


}