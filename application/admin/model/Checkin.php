<?php
/**
 * Created by PhpStorm.
 * User: ZYT
 * Date: 2017/4/15
 * Time: 14:46
 */

namespace app\admin\model;


use app\common\model\CommonModel;

class Checkin extends CommonModel
{
    public function patient(){
        return $this->belongsTo("Patient");
    }

    public function department(){
        return $this->belongsTo("Department");
    }

    public function bed(){
        return $this->hasOne("Bed","checkin_id");
    }
}