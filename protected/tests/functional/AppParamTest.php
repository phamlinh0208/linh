<?php

class AppParamTest extends WebTestCase
{
	public $fixtures=array(
		'appParams'=>'AppParam',
	);

	public function testShow()
	{
		$this->open('?r=appParam/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=appParam/create');
	}

	public function testUpdate()
	{
		$this->open('?r=appParam/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=appParam/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=appParam/index');
	}

	public function testAdmin()
	{
		$this->open('?r=appParam/admin');
	}
}
