<?php
/**
 * Created by PhpStorm.
 * User: ZYT
 * Date: 2017/4/10
 * Time: 11:24
 */

namespace app\admin\controller;

use app\admin\model\Patient as ModelPatient;

class Patient extends CommonController
{
    public function index()
    {
        return $this->fetch("patient",["title" => "病人管理"]);
    }

    public function getList(){
        $datalist = ModelPatient::all();
        foreach ($datalist as $item)
        {
            $item->citizen_ID_number = substr($item->citizen_ID_number,0,3)."***".substr($item->citizen_ID_number,-3);
        }
        return $datalist;
    }

    public function edit($id = null){
        if($id != null){
            $patient = ModelPatient::get($id);
            $this->assign("patient",$patient);
        }
        return $this->fetch('edit');
    }

    public function save(){
        $mode = $_POST["mode"];
        $patient = $_POST["patient"];
        if($mode == 'edit'){
            $new = ModelPatient::get($patient["id"]);
        }
        else{
            $new = new ModelPatient();
        }
        foreach ($patient as $key=>$keyvalue)
        {
            $new[$key] = $keyvalue;
        }
        $new->save();
        return show(1,"保存成功",$new);
    }

    public function delete(){
        $patient_id = $_POST["patientid"];
        $patient = ModelPatient::get($patient_id);
        $patient->delete();
        return show(1,"删除成功");
    }

}