<?php

class DepartmentTest extends WebTestCase
{
	public $fixtures=array(
		'departments'=>'Department',
	);

	public function testShow()
	{
		$this->open('?r=department/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=department/create');
	}

	public function testUpdate()
	{
		$this->open('?r=department/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=department/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=department/index');
	}

	public function testAdmin()
	{
		$this->open('?r=department/admin');
	}
}
