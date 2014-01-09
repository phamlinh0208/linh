<?php

class QuestionTest extends WebTestCase
{
	public $fixtures=array(
		'questions'=>'Question',
	);

	public function testShow()
	{
		$this->open('?r=question/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=question/create');
	}

	public function testUpdate()
	{
		$this->open('?r=question/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=question/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=question/index');
	}

	public function testAdmin()
	{
		$this->open('?r=question/admin');
	}
}
