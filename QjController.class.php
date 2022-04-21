<?php

class QjController{
	
	public function qjAction(){
		if(!empty($_GET['qjid'])){
			$id=$_GET['qjid'];	
			$model=new StuqjModel();
			$rows=$model->getqjDayId($id);
			if($rows==null){
				$modelbus=new StubusModel();
				$rows=$modelbus->getListId($id);
				$model->Insert($id,$rows['name'],$rows['gradeid'],$rows['classid'],$rows['batch'],$rows['busnum']);
				echo '<script>alert("请假成功！");window.location.href="index.php"</script>';
				exit;
			}else{
				header("content-type:text/html;charset=utf-8");
				echo '<script> alert("今天已经请假了");window.location.href="index.php"</script>';
			}
		}

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
		$list1=array();
		//得到所有晚上乘车人员名单
		$modelbus=new StubusModel();
		$list=$modelbus->getListA($_SESSION['gradeid'],$_SESSION['classid'],-1,-1,-2);
		//得到请假模型对象
		$model=new StuqjModel();
		foreach ($list as $rows) {
			$id=$rows['id'];
			if($model->getqjDayId($id)!=null)
				continue;
			$list1[]=$rows;
		}
		$num=1;

			//时间限制
		
		$nowtime = time();
		$start = strtotime('7:00:00');
		$end = strtotime('17:40:00');
		if ($nowtime >= $end || $nowtime <= $start){
			header("content-type:text/html;charset=utf-8");
			echo '<script> alert("不在请假时间");window.location.href="index.php"</script>';
			exit;
		}
		

		require './qj.html';
	}

}