<?php
/**
 * Created by PhpStorm.
 * User: ZYT
 * Date: 2017/4/10
 * Time: 11:24
 */

namespace app\admin\controller;

use app\admin\model\Patient as ModelList;

class Patient extends CommonController
{
    public function index()
    {
        return $this->fetch("patient",["title" => "病人管理"]);
    }

    public function getList(){
        $datalist = ModelList::all();
        foreach ($datalist as $item)
        {
            $item->citizen_ID_number = substr($item->citizen_ID_number,0,3) + "***" + substr($item->citizen_ID_number,-3);
        }
        return $datalist;
    }

}