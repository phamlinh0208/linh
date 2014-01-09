<?php

class RightTest extends WebTestCase
{
	public $fixtures=array(
		'rights'=>'Right',
	);

	public function testShow()
	{
		$this->open('?r=right/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=right/create');
	}

	public function testUpdate()
	{
		$this->open('?r=right/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=right/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=right/index');
	}

	public function testAdmin()
	{
		$this->open('?r=right/admin');
	}
}
