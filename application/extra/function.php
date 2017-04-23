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

//使用: startsWith($req_sql, ‘delete’); // $req_sql字符串是否以delete开头
function startsWith($haystack,$needle,$case=false) {
    if($case){
        return (strcmp(substr($haystack, 0, strlen($needle)),$needle)===0);
    }
    return (strcasecmp(substr($haystack, 0, strlen($needle)),$needle)===0);
}

//使用: endsWith($req_sql, ‘limit 1’); // $req_sql字符串是否以limit 1结尾
function endsWith($haystack,$needle,$case=false) {
    if($case){
        return (strcmp(substr($haystack, strlen($haystack) - strlen($needle)),$needle)===0);
    }
    return (strcasecmp(substr($haystack, strlen($haystack) - strlen($needle)),$needle)===0);
}