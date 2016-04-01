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



function convert_to_all_code($code){

    $status = 0;
    $arr = token_get_all($code);
    $buf=array();

    foreach($arr as $row){
        switch($status){

            case 0:{
                if(is_array($row)){
                    switch($row[0]){
                        case 321:{
                            $buf[]="echo ".var_export($row[1],1).";";
                            break;
                        }
                        case 379:{
                            $status=1;
                            break;
                        }
                    }
                }
                break;
            }
            //php 代码块内部
            case 1:{
                if(is_array($row)){
                    switch($row[0]){
                        case 381:{
                            $status=0;
                            break;
                        }
                        default:{
                            $buf[]=$row[1];
                        }
                    }
                }else{
                    $buf[]=$row;
                }
            }
        }

    }
    //print_r($arr);
    return implode("",$buf);
}

$code = convert_to_all_code($code);
//echo "new code\n";
//echo $code;
$code = "<?php eval(base64_decode('".base64_encode($code)."'));";
$tpl.=md5($code)."\n?>";
$tpl.=$code;

rename($file,$file.'.bak');
file_put_contents($file,$tpl);
echo "\nsign $file ok\n";
echo "bak $file => $file.bak\n";
