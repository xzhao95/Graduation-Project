<?php
/**
 * Created by PhpStorm.
 * User: ZYT
 * Date: 2017/4/11
 * Time: 15:56
 */

namespace app\admin\controller;


use app\admin\model\Patient;
use think\View;

class Checkin extends CommonController
{
    public function index(){
        $this->assign("title" , "入院登记");
        return $this->fetch("checkin");
    }

    public function getMessage(){
        $patientid = $_POST["patientid"];
        if(!trim($patientid)){
            return show(0,"病人号码不能为空");
        }
        $patient = new Patient();
        $ret = $patient->getPatientByUser($patientid);
        if($ret == null || !is_array($ret))
            return show(0,"未查询到该病人");
        return show(1,"查询成功",$ret);
    }

}