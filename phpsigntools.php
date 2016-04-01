<?php
/**
 * 对某个代码签名,修改后拒绝运行
 * php  phpsigntools.php ../code/xxx.php
 * User: sdm
 * Date: 16/4/1
 * Time: 21:06
 */



$file = $_SERVER['argv'][1];

if(!is_file($file)){
    die("error file:$file\n");
}
$code = file_get_contents($file);
$tpl='<?php $__code=file_get_contents(__FILE__);$__code_arr=explode("\n",$__code,2);$__code_head = $__code_arr[0];$__code_head_arr = explode("//",$__code_head);$sign = array_pop($__code_head_arr);if(md5(substr($__code_arr[1],2))!=$sign){die("sign error\n");}//';
$__code=file_get_contents($file);$__code_arr=explode("\n",$__code,2);$__code_head = $__code_arr[0];$__code_head_arr = explode('//',$__code_head);$sign = $__code_head_arr[1];

$tpl.=md5($code)."\n?>";
$tpl.=$code;
rename($file,$file.'.bak');
file_put_contents($file,$tpl);
echo "\nsign $file ok\n";
echo "bak $file => $file.bak\n";