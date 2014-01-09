<?php

class SurveyAnswerDetailTest extends WebTestCase
{
	public $fixtures=array(
		'surveyAnswerDetails'=>'SurveyAnswerDetail',
	);

	public function testShow()
	{
		$this->open('?r=surveyAnswerDetail/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=surveyAnswerDetail/create');
	}

	public function testUpdate()
	{
		$this->open('?r=surveyAnswerDetail/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=surveyAnswerDetail/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=surveyAnswerDetail/index');
	}

	public function testAdmin()
	{
		$this->open('?r=surveyAnswerDetail/admin');
	}
}
