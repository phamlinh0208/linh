<?php

class SurveyTypeTest extends WebTestCase
{
	public $fixtures=array(
		'surveyTypes'=>'SurveyType',
	);

	public function testShow()
	{
		$this->open('?r=surveyType/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=surveyType/create');
	}

	public function testUpdate()
	{
		$this->open('?r=surveyType/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=surveyType/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=surveyType/index');
	}

	public function testAdmin()
	{
		$this->open('?r=surveyType/admin');
	}
}
