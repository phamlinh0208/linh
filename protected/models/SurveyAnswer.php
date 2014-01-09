<?php

/**
 * This is the model class for table "survey_answer".
 *
 * The followings are the available columns in table 'survey_answer':
 * @property integer $sur_ans_id
 * @property integer $user_id
 * @property integer $sur_id
 * @property integer $staff_id
 * @property string $create_datetime
 */
class SurveyAnswer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SurveyAnswer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'survey_answer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, sur_id, staff_id, create_datetime', 'required'),
			array('user_id, sur_id, staff_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sur_ans_id, user_id, sur_id, staff_id, create_datetime', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'staff' => array(self::BELONGS_TO, 'Staff', 'staff_id'),
			'user' => array(self::BELONGS_TO, 'TblUsers', 'user_id'),
			'survey_answer_details' => array(self::HAS_MANY, 'SurveyAnswerDetail', 'sur_ans_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sur_ans_id' => 'Sur Ans',
			'user_id' => 'User',
			'sur_id' => 'Sur',
			'staff_id' => 'Staff',
			'create_datetime' => 'Create Datetime',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('sur_ans_id',$this->sur_ans_id);

		$criteria->compare('user_id',$this->user_id);

		$criteria->compare('sur_id',$this->sur_id);

		$criteria->compare('staff_id',$this->staff_id);

		$criteria->compare('create_datetime',$this->create_datetime,true);

		return new CActiveDataProvider('SurveyAnswer', array(
			'criteria'=>$criteria,
		));
	}
}