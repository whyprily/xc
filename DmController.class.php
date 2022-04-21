<?php

class DmController{

	public function dmAction(){
		if(!empty($_GET['qqid'])){
			$id=$_GET['qqid'];
			$model=new StuqjModel();			
			$rows=$model->getqjDayId($id);
			if($rows==null){
				$modelbus=new StubusModel();
				$rows=$modelbus->getListId($id);
				$model->Insert($id,$rows['name'],$rows['gradeid'],$rows['classid'],$rows['batch'],$rows['busnum'],2);
				echo '<script>window.location.href="index.php?c=dm&a=dm"</script>';
				exit;
			}
		}

		if(count($_SESSION)==0){
			$_SESSION['gradeid']=0;
			$_SESSION['classid']=0;
			$_SESSION['busnum']=0;
			$_SESSION['batch']=0;
		}

		if(isset($_GET['czch'])){
			$_SESSION['busnum']=$_GET['czch'];			
		}
		if(isset($_GET['czpc'])){
			$_SESSION['batch']=$_GET['czpc'];
		}
		$busnum=$_SESSION['busnum'];
		$batch=$_SESSION['batch'];
		$num=1;
		$num1=0;
		$list1=array();
		//得到晚上不乘车名单
		$modelbus=new StubusModel();
		$listwbc=$modelbus->getListA(-1,-1,$batch,$busnum,3);
		//得到晚上请假或缺勤名单
		$model=new StuqjModel();
		$listqq=$model->getDay($batch,$busnum);
		//得到所有晚上乘车人员名单
		$modelbus=new StubusModel();
		$list=$modelbus->getListA(-1,-1,$batch,$busnum,-2);
		foreach ($list as $rows) {
			$id=$rows['id'];
			if($model->getqjDayId($id)!=null)
				continue;
			$num1++;
			$list1[]=$rows;
		}
		$num_qc=1;
		$num_wbc=1;
		
		//时间限制

		$nowtime = time();
		$start = strtotime('17:00:00');
		$end = strtotime('18:00:00');
		if ($nowtime >= $end || $nowtime <= $start){
			header("content-type:text/html;charset=utf-8");
			echo '<script> alert("不在点名时间");window.location.href="index.php"</script>';
			exit;
		}


		require './dm.html';
	}

}