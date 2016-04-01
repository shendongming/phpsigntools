<?php $__code=file_get_contents(__FILE__);$__code_arr=explode("\n",$__code,2);$__code_head = $__code_arr[0];$__code_head_arr = explode("//",$__code_head);$sign = array_pop($__code_head_arr);if(md5(substr($__code_arr[1],2))!=$sign){echo substr($__code_arr[1],2);echo $sign;};//c704709a952eac709ee6b2bcc8d9679b
?><?php
/**
 * Created by PhpStorm.
 * User: sdm
 * Date: 16/4/1
 * Time: 21:08
 */


function test_fun($s){
    return $s;
}

echo "load lib\n";