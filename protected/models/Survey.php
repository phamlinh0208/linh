<?php

/**
 * This is the model class for table "survey".
 *
 * The followings are the available columns in table 'survey':
 * @property integer $sur_id
 * @property string $sur_name
 * @property string $create_datetime
 * @property integer $sur_type_id
 * @property string $sur_status
 * @property string $description
 */
class Survey extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Survey the static model class
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
		return 'survey';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sur_name, sur_type_id', 'required'),
			array('sur_type_id', 'numerical', 'integerOnly'=>true),
			array('sur_status', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sur_id, sur_name, create_datetime, sur_type_id, sur_status, description', 'safe', 'on'=>'search'),
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
			'questions' => array(self::HAS_MANY, 'Question', 'sur_id'),
			'sur_type' => array(self::BELONGS_TO, 'SurveyType', 'sur_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sur_id' => Yii::t('survey','sur_id'),
			'sur_name' => Yii::t('survey','sur_name'),
			'create_datetime' => Yii::t('survey','create_datetime'),
			'sur_type_id' => Yii::t('survey','sur_type_id'),
			'sur_status' => Yii::t('survey','sur_status'),
			'description' => Yii::t('survey','description'),
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

		$criteria->compare('sur_id',$this->sur_id);

		$criteria->compare('sur_name',$this->sur_name,true);

		$criteria->compare('create_datetime',$this->create_datetime,true);

		$criteria->compare('sur_type_id',$this->sur_type_id);

		$criteria->compare('sur_status',$this->sur_status,true);

		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider('Survey', array(
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
    public function  getSurveyTypeName($sur_type_id)
    {
        $sur_type_name='';
        $data=SurveyType::model()->findAll(array( 'condition'=>'sur_type_id='.$sur_type_id,));
        foreach ($data as $row)
        {
            $sur_type_name=$row['sur_type_name'];
        }
        return $sur_type_name;
    }
}