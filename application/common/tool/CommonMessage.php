<?php
/**
 * Created by PhpStorm.
 * User: ZYT
 * Date: 2017/4/13
 * Time: 15:55
 */

namespace app\common\tool;

use app\admin\model\Department;

class CommonMessage
{
    /**
     * 获取所有部门
     * @return array
     */
    public function getAllDepartment()
    {
        $list = Department::all();
        $deps = array();
        foreach ($list as $de){
            array_push($deps,$de->name);
        }
        return $deps;
    }
}