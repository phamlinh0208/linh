<?php

/**
 * This is the model class for table "promotion".
 *
 * The followings are the available columns in table 'promotion':
 * @property integer $id
 * @property string $name
 * @property string $content
 * @property string $start_date
 * @property string $end_date
 * @property string $description
 */
class Promotion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Promotion the static model class
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
		return 'promotion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, content, start_date, end_date', 'required'),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, content, start_date, end_date, description', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('promotion','id'),
			'name' => Yii::t('promotion','name'),
			'content' => Yii::t('promotion','content'),
			'start_date' =>Yii::t('promotion','start_date'),
			'end_date' => Yii::t('promotion','end_date'),
			'description' => Yii::t('promotion','description'),
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

		$criteria->compare('id',$this->id);

		$criteria->compare('name',$this->name,true);

		$criteria->compare('content',$this->content,true);

		$criteria->compare('start_date',$this->start_date,true);

		$criteria->compare('end_date',$this->end_date,true);

		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider('Promotion', array(
			'criteria'=>$criteria,
		));
	}
}