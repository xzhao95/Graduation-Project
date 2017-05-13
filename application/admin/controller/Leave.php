<?php
/**
 * Created by PhpStorm.
 * User: ZYT
 * Date: 2017/5/10
 * Time: 23:55
 */

namespace app\admin\controller;


use app\admin\model\ChargeDetails;
use app\admin\model\Checkin;
use app\admin\model\PaymentType;

class Leave extends CommonController
{
    public function index($id = null){
        if($id != null){
            $checkin = Checkin::get(["patient_id" => $id, "leave_id" => null]);
        }
        $paymentType = PaymentType::all();
        $this->assign("paymentType",$paymentType);
        return $this->fetch('index',["title" => "出院结算"]);
    }

    public function getmessage(){
        $checkinid = $_POST["checkinid"];
        $charge = ChargeDetails::get(['checkin_id'=>$checkinid]);
        if($charge == null)
            return show(0,"未找到该住院信息");
//        $view = new View();
//        $view->charge = $charge;
//        $paymentType = PaymentType::all();
//        $view->paymentType = $paymentType;
//        $view->fetch('index',["title" => "出院结算"]);
        return show(1,"查询成功",$charge);

    }

    public function settle(){
        $checkinid = $_POST["checkinid"];
        $payment = $_POST["payment"];
		$charger= $_POST["charger"];
		$payment_type= $_POST["payment_type"];
        $charge = ChargeDetails::get(['checkin_id'=>$checkinid]);
        $charge->payment = $payment;
        $charge->charger_id = $charger;
        $charge->payment_type_id = PaymentType::get(['name'=>$payment_type])->id;
        $charge->save();
        return show(1,"结算成功",$charge);
    }
}