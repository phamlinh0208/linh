<?php

/**
 * This is the model class for table "doctor".
 *
 * The followings are the available columns in table 'doctor':
 * @property integer $doctor_id
 * @property string $name
 * @property string $email
 * @property string $phone_number
 * @property string $fax
 * @property string $office
 * @property integer $member_type
 * @property integer $event_type
 * @property integer $dep_id
 */
class Doctor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Doctor the static model class
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
		return 'doctor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,email, phone_number', 'required'),
			array('member_type, event_type, dep_id', 'numerical', 'integerOnly'=>true),
			array('email, fax, office', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('doctor_id, name, email, phone_number, fax, office, member_type, event_type, dep_id', 'safe', 'on'=>'search'),
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
            'images' => array(self::HAS_MANY, 'Image', 'doctor_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'doctor_id' =>  Yii::t('doctor','doctor_id'),
			'name' =>  Yii::t('doctor','name'),
			'email' =>  Yii::t('doctor','email'),
			'phone_number' =>  Yii::t('doctor','phone_number'),
			'fax' => Yii::t('doctor','fax'),
			'office' => Yii::t('doctor','office'),
			'member_type' =>  Yii::t('doctor','member_type'),
			'event_type' =>  Yii::t('doctor','event_type'),
			'dep_id' =>  Yii::t('doctor','dep_id'),
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

		$criteria->compare('doctor_id',$this->doctor_id);

		$criteria->compare('name',$this->name,true);

		$criteria->compare('email',$this->email,true);

		$criteria->compare('phone_number',$this->phone_number,true);

		$criteria->compare('fax',$this->fax,true);

		$criteria->compare('office',$this->office,true);

		$criteria->compare('member_type',$this->member_type);

		$criteria->compare('event_type',$this->event_type);

		$criteria->compare('dep_id',$this->dep_id);

		return new CActiveDataProvider('Doctor', array(
			'criteria'=>$criteria,
		));
	}
    public function  getMemberTypeName($member_id)
    {
        $sur_type_name='';
        $member_type='"staff_member"';
        $data=AppParam::model()->findAll(array( 'condition'=>'par_type='.$member_id.' and par_name='.$member_type));
        foreach ($data as $row)
        {
            $sur_type_name=$row['par_value'];
        }
        return $sur_type_name;
    }
    public function  getEventName($event_id)
    {
        $event_name='';
        $event_type='"event_type"';
        $data=AppParam::model()->findAll(array( 'condition'=>'par_type='.$event_id.' and par_name='.$event_type));
        foreach ($data as $row)
        {
            $event_name=$row['par_value'];
        }
        return $event_name;
    }

    public function  getDepartmentName($dep_id)
    {
        $dep_name='';
        $data=Department::model()->findAll(array( 'condition'=>'dep_id='.$dep_id,));
        foreach ($data as $row)
        {
            $dep_name=$row['dep_name'];
        }
        return $dep_name;
    }
}