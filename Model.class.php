<?php

/**
 * @Author: zhj
 * @Date:   2022-02-27 19:42:58
 * @Last Modified by:   zhj
 * @Last Modified time: 2022-02-27 19:43:40
 */
class Model{
	protected $mypdo;
	public function __construct(){
		$this->initMyPDO();
	}

	private function initMyPDO(){
		$param=array(
			'user'=>'root',
			'pwd'=>'root'
			);
		$this->mypdo=MyPDO::getInstance($param);
	}
}