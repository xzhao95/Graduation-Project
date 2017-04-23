<?php
/**
 * Created by PhpStorm.
 * User: ZYT
 * Date: 2017/4/12
 * Time: 16:30
 */

namespace app\admin\model;


use app\common\model\CommonModel;

class PatientContact extends CommonModel
{
    /**
     * 根据病人id获取联系人信息
     */
    public function getMessageByPatid($patientid)
    {
        return $this->where("patient_id",$patientid)->find()->getData();
    }

}