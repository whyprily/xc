<?php
class ShowController{

	public function showAction(){
		$model=new StuqjModel();
		$listqq=$model->getqqDay();
		$listqj=$model->getqjDay();
		$numqq=1;
		$numqj=1;
		require './show.html';
	}
	
}