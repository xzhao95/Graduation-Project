<?php
/**
 * Created by PhpStorm.
 * User: ZYT
 * Date: 2017/4/14
 * Time: 0:08
 */

namespace app\admin\controller;
use app\admin\model;
use app\admin\model\Bed as ModelBed;

class Bed extends CommonController
{
    /**
     * @return false|static[]
     */
    public function getEmptyList()
    {
        $allbed =  ModelBed::all(['empty'=>1]);
        $bedlist = array();
        foreach ($allbed as $bed) {
            $bed->department = $bed->department->name;;
            $bed->type = $bed->type->cname;
        }
        $result["total"] = count($allbed);
        //获取的记录
        $result["rows"] = $allbed;
        return $allbed;
    }

    /**
     * 获得所有床位
     */
    public function getList()
    {
        $allbed =  ModelBed::all();
        foreach ($allbed as $bed) {
            $bed->department = $bed->department;
            $bed->type = $bed->type;
            $bed->checkin = $bed->checkin;
            if( $bed->checkin ){
                $bed->checkin->patient = $bed->checkin->patient;
                $bed->checkin->department = $bed->checkin->department;
            }
        }
        return $allbed;
    }


    /**
     *
     */
    public function index(){
        return $this->fetch("index",["title" => "床位管理"]);
    }

    public function add(){

    }

    public function distribution($bedid)
    {
        $bed = ModelBed::get($bedid);
        $this->assign("bed",$bed);
        return $this->fetch("distributionBed");
    }

    public function distributionBed(){
        $bed_id = $_POST["bed_id"];
        $checkin_id = $_POST["checkin_id"];
        $bed = ModelBed::get($bed_id);
        $bed->checkin_id = $checkin_id;
        $bed->save();
        return show(1,"分配成功");
    }

    public function contract($bedid){
        $bed = ModelBed::get($bedid);
        $this->assign("bed",$bed);
        return $this->fetch("contractBed");
    }

    public function getNoCheckinBed(){
        $list = ModelBed::all(function($query){
            $query->where('checkin_id', null);
        });
        foreach($list as $bed){
            $bed->type = $bed->type;
            $bed->department = $bed->department;
        }
        return $list;
    }

    public function contractBed(){
        $checkin_id = $_POST["checkin_id"];
        $bedlist = $_POST["bed"];
        foreach ($bedlist as $item) {
            $bed = ModelBed::get($item['id']);
            $bed->checkin_id = $checkin_id;
            $bed->save();
        }
        return show(1,"包床成功");
    }

    public function handleBed($bedid, $mode){
        $bed = ModelBed::get($bedid);
        $this->assign("bed",$bed);
        return $this->fetch($mode);
    }

    public function getCheckinBed($bedid){
        $bed = ModelBed::get($bedid);
        $list = ModelBed::all(['checkin_id'=>$bed->checkin_id]);
        foreach($list as $item){
            $item->type = $item->type;
            $item->department = $item->department;
        }
        return $list;
    }

    public function  returnBed(){
        $bedlist = $_POST["bed"];
        foreach ($bedlist as $item){
            $bed = ModelBed::get($item['id']);
            $bed->checkin_id = null;
            $bed->save();
        }
        return show(1,"退床成功");
    }

    public  function turnBed(){
        $old_id = $_POST["old_id"];
        $new_id = $_POST["new_id"];
        $oldBed = ModelBed::get($old_id);
        $newBed = ModelBed::get($new_id);
        $newBed->checkin_id = $oldBed->checkin_id;
        $oldBed->checkin_id = null;
        $newBed->save();
        $oldBed->save();
        return show(1,"转床成功");
    }
}