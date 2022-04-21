<?php

class CxController{
	//查询控制器
	public function CxAction(){
		$model=new StubusModel();			
		if(count($_SESSION)==0){
			$_SESSION['gradeid']=0;
			$_SESSION['classid']=0;
			$_SESSION['busnum']=0;
			$_SESSION['batch']=0;
		}
		if(isset($_GET['cznj'])){
			$_SESSION['gradeid']=$_GET['cznj'];
		}
		if(isset($_GET['czbj'])) {
			$_SESSION['classid']=$_GET['czbj'];
		}
		if(isset($_GET['czch'])){
			$_SESSION['busnum']=$_GET['czch'];
		}
		if(isset($_GET['czpc'])){
			$_SESSION['batch']=$_GET['czpc'];
		}		
		$list=$model->getListA($_SESSION['gradeid'],$_SESSION['classid'],$_SESSION['batch'],$_SESSION['busnum']);
		$num=1;
		require './cx.html';
	}
}