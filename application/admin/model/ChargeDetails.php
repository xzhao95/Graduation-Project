<?php
/**
 * Created by PhpStorm.
 * User: ZYT
 * Date: 2017/5/11
 * Time: 22:31
 */

namespace app\admin\model;


use app\common\model\CommonModel;

class ChargeDetails extends CommonModel
{
    public function payment_type(){
        return $this->belongsTo("PaymentType");
    }

    public function charger(){
        return $this->belongsTo("User");
    }
}