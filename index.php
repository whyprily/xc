
<?php
session_start();
date_default_timezone_set('PRC');
//自动加载类
spl_autoload_register(function($class_name){
	require "./{$class_name}.class.php";
});
$c=$_GET['c']??'show';
$a=$_GET['a']??'show';
$c=ucfirst(strtolower($c));
$a=strtolower($a);
$controller_name=$c.'Controller';
$action_name=$a.'Action';
$obj=new $controller_name();
$obj->$action_name();
?>