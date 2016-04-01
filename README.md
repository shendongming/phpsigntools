# phpsigntools

vim test1.php
```php
<?php 
echo time();
```
➜  phpsigntools git:(master) ✗ php test1.php
1459519546%

php  phpsigntools.php test1.php
➜  phpsigntools git:(master) ✗ php  phpsigntools.php test1.php

sign test1.php ok
bak test1.php => test1.php.bak
➜  phpsigntools git:(master) ✗ php test1.php
1459519571%

➜  phpsigntools git:(master) ✗ vim test1.php
```php
<?php $__code=file_get_contents(__FILE__);$__code_arr=explode("\n",$__code,2);$__code_head = $__code_arr[0];$__code_head_arr = explode("//",$__code_head);$sign = array_pop($__code_head_arr);if(md5(substr($__code_arr[1],2))!=$sign){die("sign error\n");}//1d5936e22168168a4d514c1e622a2866
?><?php
echo time();
//add test
echo 'hi';
```
➜  phpsigntools git:(master) ✗ php test1.php
sign error


