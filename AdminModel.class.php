<?php

class AdminModel extends Model{

	public function getStations(){
		return $this->mypdo->fetchAll("SELECT * FROM station ORDER BY sorder ASC");
	}

	public function addStation($name,$order){
		$name=$this->mypdo->quote($name);
		$this->mypdo->exec("INSERT INTO station VALUES(null,{$name},{$order})");
	}

	public function delStation($id){
		$this->mypdo->exec("DELETE FROM station WHERE id={$id}");
	}

	// 车号管理
	public function getBusList(){
		return $this->mypdo->fetchAll("SELECT * FROM bus ORDER BY number ASC");
	}

	public function addBus($number, $name, $capacity){
		$number = (int)$number;
		$name = $this->mypdo->quote($name);
		$capacity = (int)$capacity;
		$this->mypdo->exec("INSERT INTO bus (number, name, capacity, status) VALUES ({$number}, {$name}, {$capacity}, 1)");
	}

	public function updateBus($id, $number, $name, $capacity, $status){
		$id = (int)$id;
		$number = (int)$number;
		$name = $this->mypdo->quote($name);
		$capacity = (int)$capacity;
		$status = (int)$status;
		$this->mypdo->exec("UPDATE bus SET number={$number}, name={$name}, capacity={$capacity}, status={$status} WHERE id={$id}");
	}

	public function delBus($id){
		$id = (int)$id;
		$this->mypdo->exec("DELETE FROM bus WHERE id={$id}");
	}

	public function getBusById($id){
		$id = (int)$id;
		return $this->mypdo->fetchRow("SELECT * FROM bus WHERE id={$id}");
	}

	public function getClasses(){
		return $this->mypdo->fetchAll("SELECT * FROM class ORDER BY gradeid,classid");
	}

	public function addClass($gradeid,$classid){
		$this->mypdo->exec("INSERT INTO class VALUES(null,{$gradeid},{$classid})");
	}

	public function delClass($id){
		$this->mypdo->exec("DELETE FROM class WHERE id={$id}");
	}

	public function getGrades(){
		return array(
			array('id'=>1,'name'=>'一年级'),
			array('id'=>2,'name'=>'二年级'),
			array('id'=>3,'name'=>'三年级'),
			array('id'=>4,'name'=>'四年级'),
			array('id'=>5,'name'=>'五年级'),
			array('id'=>6,'name'=>'六年级'),
		);
	}

	public function getStudents(){
		$sql="SELECT s.*,st.name as stationname 
				FROM stubus s 
				LEFT JOIN station st ON s.sationid=st.id
				ORDER BY s.gradeid,s.classid,s.id";
		return $this->mypdo->fetchAll($sql);
	}

	public function getStudentById($id){
		return $this->mypdo->fetchRow("SELECT * FROM stubus WHERE id={$id}");
	}

	public function addStudent($data){
		$name=$this->mypdo->quote($data['name']);
		$sex=$this->mypdo->quote($data['sex']);
		$gradeid=$data['gradeid'];
		$classid=$data['classid'];
		$batch=$data['batch'];
		$busnum=$data['busnum'];
		$model=$data['model'];
		$sationid=$data['sationid']??0;
		$this->mypdo->exec("INSERT INTO stubus VALUES(null,{$name},{$sex},{$gradeid},{$classid},{$batch},{$busnum},{$model},{$sationid})");
	}

	public function updateStudent($data,$id){
		$name=$this->mypdo->quote($data['name']);
		$sex=$this->mypdo->quote($data['sex']);
		$gradeid=$data['gradeid'];
		$classid=$data['classid'];
		$batch=$data['batch'];
		$busnum=$data['busnum'];
		$model=$data['model'];
		$sationid=$data['sationid']??0;
		$this->mypdo->exec("UPDATE stubus SET name={$name},sex={$sex},gradeid={$gradeid},classid={$classid},batch={$batch},busnum={$busnum},model={$model},sationid={$sationid} WHERE id={$id}");
	}

	public function delStudent($id){
		$this->mypdo->exec("DELETE FROM stubus WHERE id={$id}");
	}

}
