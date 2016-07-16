<?php
/**
 * 生成验证码
 * @param  integer $type   [description]
 * @param  integer $length [description]
 * @return [type]          [description]
 */
function buildRandomString($type=1 , $length=4){
    if ($type == 1) {
        $chars = implode("",range(0, 9));
    } else if ($type == 2) {
        $chars = implode("",array_merge(range("a","z"),range("A", "Z")));
        //var_dump(range("a", "Z")); //range("a", "Z")不能生成a-zA-Z的数组
    } else if ($type == 3) {
        $chars = implode("", array_merge(range("a","z"),range("A","Z"),range(0,9)));
    }
    if($length>strlen($chars)){
        exit("字符串长度不够");
    }
    $chars = str_shuffle($chars);
    return substr($chars, 0, $length);
}
/**
 * 生成唯一字符串
 * @return [type] [description]
 */
function getUniName(){
    return md5(uniqid(microtime(true),true));
}
/**
 * 得到文件扩展名
 * @param  [type] $filename [description]
 * @return [type]           [description]
 */
function getExt($filename){
    $temp = explode(".",$filename);
    return strtolower(end($temp));
    //explode(".",)通过"."字符串分割
    //end(array)返回array最后一个元素的值
    //strtolower()字符转换为小写
}