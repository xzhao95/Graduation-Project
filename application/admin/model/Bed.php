<?php
/**
 * Created by PhpStorm.
 * User: ZYT
 * Date: 2017/4/13
 * Time: 17:26
 */

namespace app\admin\model;

use app\common\model\CommonModel;

class Bed extends CommonModel
{
    public function type()
    {
        return $this->belongsTo('BedType', 'type_id');
    }

    public function department()
    {
        return $this->belongsTo('Department', 'department_id');
    }

    public function getEmptyAttr($value)
    {
        $empty = [1 => '有空', 0 => '已满'];
        return $empty[$value];
    }
}
   