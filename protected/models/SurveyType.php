<?php

/**
 * This is the model class for table "survey_type".
 *
 * The followings are the available columns in table 'survey_type':
 * @property integer $sur_type_id
 * @property string $sur_type_name
 * @property string $sur_type_status
 * @property string $description
 */
class SurveyType extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return SurveyType the static model class
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
		return 'survey_type';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sur_type_name', 'required'),
			array('sur_type_status', 'length', 'max'=>1),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sur_type_id, sur_type_name, sur_type_status, description', 'safe', 'on'=>'search'),
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
			'surveys' => array(self::HAS_MANY, 'Survey', 'sur_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sur_type_id' => Yii::t('survey_type','sur_type_id'),
			'sur_type_name' => Yii::t('survey_type','sur_type_name'),
			'sur_type_status' => Yii::t('survey_type','sur_type_status'),
			'description' => Yii::t('survey_type','description'),
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

		$criteria->compare('sur_type_id',$this->sur_type_id);

		$criteria->compare('sur_type_name',$this->sur_type_name,true);

		$criteria->compare('sur_type_status',$this->sur_type_status,true);

		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider('SurveyType', array(
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
}