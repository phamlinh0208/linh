<?php

class StaffTest extends WebTestCase
{
	public $fixtures=array(
		'staffs'=>'Staff',
	);

	public function testShow()
	{
		$this->open('?r=staff/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=staff/create');
	}

	public function testUpdate()
	{
		$this->open('?r=staff/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=staff/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=staff/index');
	}

	public function testAdmin()
	{
		$this->open('?r=staff/admin');
	}
}
