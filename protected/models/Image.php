<?php

/**
 * This is the model class for table "image".
 *
 * The followings are the available columns in table 'image':
 * @property integer $id
 * @property string $img_url
 * @property integer $dep_id
 * @property integer $doctor_id
 */
class Image extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Image the static model class
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
		return 'image';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('img_url', 'required'),
			array('dep_id,doctor_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, img_url,doctor_id, dep_id', 'safe', 'on'=>'search'),
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
			'department' => array(self::BELONGS_TO, 'Department', 'dep_id'),
            'doctor' => array(self::BELONGS_TO, 'Doctor', 'doctor_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'img_url' => 'Img Url',
			'dep_id' => 'Department',
            'doctor_id'=>'Doctor'
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

		$criteria->compare('img_url',$this->img_url,true);

		$criteria->compare('dep_id',$this->dep_id);
        $criteria->compare('doctor_id',$this->doctor_id);


		return new CActiveDataProvider('Image', array(
			'criteria'=>$criteria,
		));
	}
}