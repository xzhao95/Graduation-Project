<?php
/**
 * Created by PhpStorm.
 * User: ZYT
 * Date: 2017/4/14
 * Time: 0:08
 */

namespace app\admin\controller;
use app\admin\model;

class Bed extends CommonController
{
    /**
     * @return false|static[]
     */
    public function getEmptyList()
    {
        $allbed = model\Bed::all(['empty'=>1]);
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
        $allbed = model\Bed::all();
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
     *
     */
    public function index(){
        return $this->fetch("index",["title" => "床位管理"]);
    }

    public function add(){

    }

}