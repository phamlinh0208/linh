<?php

class SurveyTest extends WebTestCase
{
	public $fixtures=array(
		'surveys'=>'Survey',
	);

	public function testShow()
	{
		$this->open('?r=survey/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=survey/create');
	}

	public function testUpdate()
	{
		$this->open('?r=survey/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=survey/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=survey/index');
	}

	public function testAdmin()
	{
		$this->open('?r=survey/admin');
	}
}
