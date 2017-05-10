<?php
/**
 * Created by PhpStorm.
 * User: ZYT
 * Date: 2017/4/11
 * Time: 15:56
 */

namespace app\admin\controller;

use app\admin\model\Bed;
use app\admin\model\Department;
use app\admin\model\Patient;
use app\admin\model\PatientContact;
use app\common\tool\CommonMessage;
use think\View;
use app\admin\model\Checkin as ModelCheckin;

class Checkin extends CommonController
{
    public function index(){
        $this->assign("title" , "入院登记");
        $common = new CommonMessage();
        $alldepartment = $common->getAllDepartment();
        $this->assign("department",$alldepartment);
        return $this->fetch("checkin");
    }

    public function getMessage(){
        $patientid = $_POST["patientid"];
        if(!trim($patientid)){
            return show(0,"病人号码不能为空");
        }
        $patient = new Patient();
        $ret = $patient->getPatientByUser($patientid);;
        $contact = new PatientContact();
        $ret["contact"] = $contact->getMessageByPatid($patientid);
        if($ret == null || !is_array($ret))
            return show(0,"未查询到该病人");
        //print_r($ret);
        return show(1,"查询成功",$ret);
    }

    public function getBed(){
        return $this->fetch("addbed");
    }

    /**
     * 添加住院登记
     */
    public function add()
    {
        $patientid = $_POST["patient_id"];
        $patientData = array();
        $contactData = array("patient_id" => $patientid);
        $checkinData = array("patient_id" => $patientid);
        $beditem = null;
        foreach($_POST as $x => $x_value){
            if(!$x_value) continue;
            if(startsWith($x,"patient_")){
                $name = substr($x,8);
                if($name == "sex"){
                    $x_value = $x_value === "man"?"男":"女";
                }
                $patientData[$name] = $x_value;
            }
            else if(startsWith($x,"contact_")){
                $name = substr($x,8);
                $contactData[$name] = $x_value;
            }
            else{
                if($x == "bed_id"){
                    $bed = explode("-",$x_value);
                    $beditem = Bed::get(['floor' => $bed[0],'room' => $bed[1],'num' => $bed[2]]);
                    continue;
                }
                if($x == "department_id"){
                    $departmentid = Department::get(["name" => $x_value])->id;
                    $x_value = $departmentid;
                }
                $checkinData[$x] = $x_value;
            }
        }
        $patient = new Patient;
        $patient->allowField(true)->save($patientData,["id" => $patientid]);
        $patientContact = new PatientContact;
        $patientContact->allowField(true)->save($contactData,["patient_id" => $patientid]);
        $checkin = new ModelCheckin($checkinData);
        $checkin->allowField(true)->save();
        if($beditem){
            $beditem->checkin_id = $checkin->id;
            $beditem.save();
        }
        return show(1,"登记成功");
    }

    public function getNoBedCheckin(){
        $list = ModelCheckin::all();
        $result = array();
        foreach ($list as $item){
            if($item->bed == null){
                $item->patient = $item->patient;
                $item->department = $item->department;
                array_push($result,$item);
            }
        }
        return $result;
    }

}