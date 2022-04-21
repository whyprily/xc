<?php

class StubusModel  extends Model{

	//得到所有人员信息
	public function getList(){
		return $this->mypdo->fetchAll('select * from stubus order by batch,busnum,gradeid,classid');
	}
	//得到查询id的人员信息
	public function getListId($id){
		return $this->mypdo->fetchRow("select * from stubus where id={$id}");
	}
	//得到单程车所有人员信息
	public function getListdc(){
		return $this->mypdo->fetchAll("select * from stubus where model!=1 order by model desc,batch,busnum");
	}
	//得到晚上坐车
	public function getListqc(){
		return $this->mypdo->fetchAll("select * from stubus where model!=3 order by gradeid,classid");
	}
	//得到晚上不坐车
	public function getListwbc(){
		return $this->mypdo->fetchAll("select * from stubus where model=3 order by gradeid,classid");
	}

	//根据参数得到不同人员信息
	//年级，班级，车次，车号，类型
	public function getListA($gradeid=-1,$classid=-1,$batch=-1,$busnum=-1,$model=-1){
		if($gradeid!=-1)
			$gradeid="gradeid=".$gradeid;
		else
			$gradeid=1;

		if($classid!=-1)
			$classid="classid=".$classid;
		else
			$classid=1;

		if($batch!=-1)
			$batch="batch=".$batch;
		else
			$batch=1;

		if($busnum!=-1)
			$busnum="busnum=".$busnum;
		else
			$busnum=1;

		//如果model=-1表示所有人，如果model=-2表示晚上要乘车
		if($model==-1)
			$model=1;
		elseif($model==-2)
			$model="model!=3";
		else
			$model="model=".$model;
		$list1=array();
		$list= $this->mypdo->fetchAll("select * from stubus where 1 and {$gradeid} and {$classid} and {$batch} and {$busnum} and {$model} order by batch,busnum,gradeid,classid");
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