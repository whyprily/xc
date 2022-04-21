<?php

class StuqjModel extends Model{
	/*
	private $param=array(
			'user'=>'root',
			'pwd'=>'root'
			);
	private $mypdo=MyPDO::getInstance($this->param);
    为什么不行？
	*/
	//查询当天请假或缺勤人ID
	public function getqjDayId($id){
		return $this->mypdo->fetchRow("select * from stuqj where nameId={$id} and createtime>=UNIX_TIMESTAMP(CURDATE())");
	}

	//返回请假的列表
	public function getqjDay(){
		$list1=array();
		$list= $this->mypdo->fetchAll("select * from stuqj where createtime>=UNIX_TIMESTAMP(CURDATE()) and model=1 order by batch,busnum,CURDATE()");
		foreach ($list as $rows) {
			switch ( $rows['gradeid']) {
				case 1:
					$rows['gradeid']='一';
					break;
				case 2:
					$rows['gradeid']='二';		
					break;
				case 3:
					$rows['gradeid']='三';		
					break;
				case 4:
					$rows['gradeid']='四';		
					break;
				case 5:
					$rows['gradeid']='五';		
					break;
				case 6:
					$rows['gradeid']='六';
					break;
			}
			$list1[]=$rows;
		}
		return $list1;
	}
	//返回缺勤的列表
	public function getqqDay(){
		$list1=array();
		$list= $this->mypdo->fetchAll("select * from stuqj where createtime>=UNIX_TIMESTAMP(CURDATE()) and model=2 order by createtime desc");
		foreach ($list as $rows) {
			switch ( $rows['gradeid']) {
				case 1:
					$rows['gradeid']='一';
					break;
				case 2:
					$rows['gradeid']='二';		
					break;
				case 3:
					$rows['gradeid']='三';		
					break;
				case 4:
					$rows['gradeid']='四';		
					break;
				case 5:
					$rows['gradeid']='五';		
					break;
				case 6:
					$rows['gradeid']='六';
					break;
			}
			$list1[]=$rows;
		}
		return $list1;
	}
	//插入请假或缺勤的人
	public function Insert($id,$name,$gradeid,$classid,$batch,$busnum,$model=1){
		$this->mypdo->exec("insert into stuqj values(null,{$id},'{$name}',{$gradeid},{$classid},{$batch},{$busnum},unix_timestamp(),{$model})");
	}
	//得到今天的请假和缺勤的人
	public function getDay($batch=-1,$busnum=-1){
		if($batch!=-1)
			$batch="batch=".$batch;
		else
			$batch=1;
		if($busnum!=-1)
			$busnum="busnum=".$busnum;
		else
			$busnum=1;

		$list1=array();
		$list= $this->mypdo->fetchAll("select * from stuqj where createtime>=UNIX_TIMESTAMP(CURDATE()) and {$batch} and {$busnum} order by model,batch,busnum");
		foreach ($list as $rows) {
			switch ( $rows['gradeid']) {
				case 1:
					$rows['gradeid']='一';
					break;
				case 2:
					$rows['gradeid']='二';		
					break;
				case 3:
					$rows['gradeid']='三';		
					break;
				case 4:
					$rows['gradeid']='四';		
					break;
				case 5:
					$rows['gradeid']='五';		
					break;
				case 6:
					$rows['gradeid']='六';
					break;
			}
			$list1[]=$rows;
		}
		return $list1;
	}
}