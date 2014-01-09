<?php

/**
 * This is the model class for table "question".
 *
 * The followings are the available columns in table 'question':
 * @property integer $question_id
 * @property string $question_text
 * @property integer $sur_id
 * @property string $status
 * @property string $description
 */
class Question extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Question the static model class
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
		return 'question';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('question_text, sur_id', 'required'),
			array('sur_id', 'numerical', 'integerOnly'=>true),
			array('status', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('question_id, question_text, sur_id, status, description', 'safe', 'on'=>'search'),
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
			'answers' => array(self::HAS_MANY, 'Answer', 'question_id'),
			'sur' => array(self::BELONGS_TO, 'Survey', 'sur_id'),
			'survey_answer_details' => array(self::HAS_MANY, 'SurveyAnswerDetail', 'question_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'question_id' => Yii::t('question','question_id'),
			'question_text' => Yii::t('question','question_text'),
			'sur_id' => Yii::t('question','sur_id'),
			'status' => Yii::t('question','status'),
			'description' => Yii::t('question','description'),
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

		$criteria->compare('question_id',$this->question_id);

		$criteria->compare('question_text',$this->question_text);

		$criteria->compare('sur_id',$this->sur_id);

		$criteria->compare('status',$this->status,true);

		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider('Question', array(
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
    public function  getSurveyName($sur_id)
    {
        $sur_name='';
        $data=Survey::model()->findAll(array( 'condition'=>'sur_id='.$sur_id,));
        foreach ($data as $row)
        {
            $sur_name=$row['sur_name'];
        }
        return $sur_name;
    }
    public function searchAnswer()
    {
        $criteria = new CDbCriteria();
        $criteria->compare('question_id',$this->question_id);
        return new CActiveDataProvider('Answer', array(
            'criteria'=>$criteria,
        ));
    }
    public function searchQuestion()
    {
        $criteria = new CDbCriteria();
        $criteria->compare('question_id',$this->question_id);
        return new CActiveDataProvider('Question', array(
            'criteria'=>$criteria,
        ));
    }
}