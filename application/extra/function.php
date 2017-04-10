<?php
/**
 * 通用的方法
 * Created by PhpStorm.
 * User: ZYT
 * Date: 2017/3/17
 * Time: 20:40
 */
function show($status,$message,$data=array()){
    $result = array(
        "status" => $status,
        "message" => $message,
        "data" => $data
    );
    exit(json_encode($result));
}