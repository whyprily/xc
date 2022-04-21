<?php
//自动加载类
spl_autoload_register(function($class_name){
	require "./{$class_name}.class.php";
});

session_start();
//实例化模型
$model=new StubusModel();
$cznj=-1;
$czbj=-1;
$czch=-1;
$czpc=-1;
if(!empty($_GET['cznj'])){
	$cznj=$_GET['cznj'];
}
if(!empty($_GET['czbj'])) {
	$czbj=$_GET['czbj'];
}
if(!empty($_GET['czch'])){
	$czch=$_GET['czch'];
}
if(!empty($_GET['czpc'])){
	$czpc=$_GET['czpc'];
}
$list=$model->getListA($cznj,$czbj,$czpc,$czch);
$num=1;
require './qjlist.html';
?>