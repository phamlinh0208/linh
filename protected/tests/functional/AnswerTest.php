<?php

class AnswerTest extends WebTestCase
{
	public $fixtures=array(
		'answers'=>'Answer',
	);

	public function testShow()
	{
		$this->open('?r=answer/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=answer/create');
	}

	public function testUpdate()
	{
		$this->open('?r=answer/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=answer/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=answer/index');
	}

	public function testAdmin()
	{
		$this->open('?r=answer/admin');
	}
}
