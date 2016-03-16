<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


header('Content-type: text/html;charset=UTF-8');
define("BASE_PATH", __DIR__);
define("LANG", "zh_CN");


//define("LANG", "en_GB");
//define("LANG", "th_TH");
require_once '/libs/common/Translate.php';
//echo "ltest <br/>";
echo __("hello world!");
echo "<br/>";
echo __("{name},hello","*",["name"=>"richard"]);

echo "branch1";

