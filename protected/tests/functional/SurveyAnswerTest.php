<?php

class SurveyAnswerTest extends WebTestCase
{
	public $fixtures=array(
		'surveyAnswers'=>'SurveyAnswer',
	);

	public function testShow()
	{
		$this->open('?r=surveyAnswer/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=surveyAnswer/create');
	}

	public function testUpdate()
	{
		$this->open('?r=surveyAnswer/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=surveyAnswer/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=surveyAnswer/index');
	}

	public function testAdmin()
	{
		$this->open('?r=surveyAnswer/admin');
	}
}
