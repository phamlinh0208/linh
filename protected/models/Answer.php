<?php

/**
 * This is the model class for table "answer".
 *
 * The followings are the available columns in table 'answer':
 * @property integer $ans_id
 * @property integer $question_id
 * @property string $ans_text
 * @property integer $ans_yn
 * @property string $ans_status
 * @property string $description
 */
class Answer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Answer the static model class
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
		return 'answer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ans_text', 'required'),
			array('question_id, ans_yn', 'numerical', 'integerOnly'=>true),
			array('ans_status', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ans_id, question_id, ans_text, ans_yn, ans_status, description', 'safe', 'on'=>'search'),
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
			'question' => array(self::BELONGS_TO, 'Question', 'question_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ans_id' => Yii::t('answer','ans_id'),
			'question_id' =>Yii::t('answer','question_id'),
			'ans_text' => Yii::t('answer','ans_text'),
			'ans_yn' => Yii::t('answer','ans_yn'),
			'ans_status' => Yii::t('answer','ans_status'),
			'description' => Yii::t('answer','description'),
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

		$criteria->compare('ans_id',$this->ans_id);

		$criteria->compare('question_id',$this->question_id);

		$criteria->compare('ans_text',$this->ans_text,true);

		$criteria->compare('ans_yn',$this->ans_yn);

		$criteria->compare('ans_status',$this->ans_status,true);

		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider('Answer', array(
			'criteria'=>$criteria,
		));
	}
    public function getStatusOptions(){
        return array('0' => Yii::t('dictionary','disable'), '1' => Yii::t('dictionary','enable'));
    }
    public function getStatusName($status)
    {
        if($status==0)
            return Yii::t('dictionary','disable');
        else if($status==1)
            return Yii::t('dictionary','enable');
        else
            return $status;
    }
    public function getYesNoOptions(){
        return array('0' => Yii::t('dictionary','no'), '1' => Yii::t('dictionary','yes'));
    }
    public function getYesNoName($yn)
    {
        if($yn==0)
            return Yii::t('dictionary','no');
        else if($yn==1)
            return Yii::t('dictionary','yes');
        else
            return $yn;
    }
    public function  getQuestionName($question_id)
    {
        $question_name='';
        $data=Question::model()->findAll(array( 'condition'=>'question_id='.$question_id?$question_id:-1,));
        foreach ($data as $row)
        {
            $question_name=$row['question_text'];
        }
        return $question_name;
    }
}