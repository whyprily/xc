<?php

class AdminController{

	public function indexAction(){
		$a='index';
		$model=new AdminModel();
		require './admin.html';
	}

	public function stationAction(){
		$model=new AdminModel();
		$list=$model->getStations();
		$num=1;
		$a='station';
		require './admin_station.html';
	}

	public function addStationAction(){
		$name=$_POST['name']??'';
		$order=$_POST['order']??0;
		if($name){
			$model=new AdminModel();
			$model->addStation($name,$order);
			echo '<script>alert("添加成功");window.location.href="index.php?c=admin&a=station"</script>';
			exit;
		}
		$a='station';
		require './admin_station_add.html';
	}

	public function delStationAction(){
		$id=$_GET['id']??0;
		if($id){
			$model=new AdminModel();
			$model->delStation($id);
		}
		header("location:index.php?c=admin&a=station");
	}

	// 车号管理
	public function busAction(){
		$model=new AdminModel();
		$list=$model->getBusList();
		$num=1;
		$a='bus';
		require './admin_bus.html';
	}

	public function addBusAction(){
		if($_POST){
			$number=$_POST['number']??'';
			$name=$_POST['name']??'';
			$capacity=$_POST['capacity']??0;
			if($number){
				$model=new AdminModel();
				$model->addBus($number,$name,$capacity);
				echo '<script>alert("添加成功");window.location.href="index.php?c=admin&a=bus"</script>';
				exit;
			}
		}
		$a='bus';
		require './admin_bus_add.html';
	}

	public function editBusAction(){
		$id=$_GET['id']??0;
		$model=new AdminModel();
		if($_POST){
			$number=$_POST['number']??'';
			$name=$_POST['name']??'';
			$capacity=$_POST['capacity']??0;
			$status=$_POST['status']??1;
			if($number && $id){
				$model->updateBus($id,$number,$name,$capacity,$status);
				echo '<script>alert("修改成功");window.location.href="index.php?c=admin&a=bus"</script>';
				exit;
			}
		}
		$row=$model->getBusById($id);
		$a='bus';
		require './admin_bus_edit.html';
	}

	public function delBusAction(){
		$id=$_GET['id']??0;
		if($id){
			$model=new AdminModel();
			$model->delBus($id);
		}
		header("location:index.php?c=admin&a=bus");
	}

	public function classAction(){
		$model=new AdminModel();
		$list=$model->getClasses();
		$num=1;
		$a='class';
		require './admin_class.html';
	}

	public function addClassAction(){
		$gradeid=$_POST['gradeid']??1;
		$classid=$_POST['classid']??1;
		if($_POST){
			$model=new AdminModel();
			$model->addClass($gradeid,$classid);
			echo '<script>alert("添加成功");window.location.href="index.php?c=admin&a=class"</script>';
			exit;
		}
		$a='class';
		require './admin_class_add.html';
	}

	public function delClassAction(){
		$id=$_GET['id']??0;
		if($id){
			$model=new AdminModel();
			$model->delClass($id);
		}
		header("location:index.php?c=admin&a=class");
	}

	public function studentAction(){
		$model=new AdminModel();
		$list=$model->getStudents();
		$num=1;
		$a='student';
		require './admin_student.html';
	}

	public function addStudentAction(){
		if($_POST){
			$model=new AdminModel();
			$model->addStudent($_POST);
			echo '<script>alert("添加成功");window.location.href="index.php?c=admin&a=student"</script>';
			exit;
		}
		$model=new AdminModel();
		$grades=$model->getGrades();
		$stations=$model->getStations();
		$a='student';
		require './admin_student_add.html';
	}

	public function editStudentAction(){
		$id=$_GET['id']??0;
		if($_POST){
			$model=new AdminModel();
			$model->updateStudent($_POST,$id);
			echo '<script>alert("修改成功");window.location.href="index.php?c=admin&a=student"</script>';
			exit;
		}
		$model=new AdminModel();
		$row=$model->getStudentById($id);
		$grades=$model->getGrades();
		$stations=$model->getStations();
		$a='student';
		require './admin_student_edit.html';
	}

	public function delStudentAction(){
		$id=$_GET['id']??0;
		if($id){
			$model=new AdminModel();
			$model->delStudent($id);
		}
		header("location:index.php?c=admin&a=student");
	}

}
