<?php

/**
 * This is the model class for table "staff".
 *
 * The followings are the available columns in table 'staff':
 * @property integer $staff_id
 * @property string $staff_code
 * @property string $staff_name
 * @property string $staff_level
 * @property string $staff_member
 * @property string $email
 * @property string $staff_address
 * @property string $phone_number
 * @property string $description
 * @property string $dep_id
 * @property string $event
 * @property string $office
 */
class Staff extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Staff the static model class
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
		return 'staff';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('staff_name,dep_id', 'required'),
			array('event,office,email, staff_address,dep_id,staff_code, phone_number,staff_level, description,staff_member', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('staff_id,event,office, staff_code,email,dep_id, staff_name,staff_level, staff_address, phone_number,staff_member,  description', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'staff_id' => Yii::t('staff','staff_id'),
			'staff_code' => Yii::t('staff','staff_code'),
			'staff_name' => Yii::t('staff','staff_name'),
			'event' => Yii::t('staff','event'),
			'staff_address' => Yii::t('staff','staff_address'),
			'phone_number' =>Yii::t('staff','phone_number'),
			'office' => Yii::t('staff','office'),
            'email'=>Yii::t('staff','email'),
			'description' => Yii::t('staff','description'),
            'staff_level'=>Yii::t('staff','staff_level'),
            'staff_member'=>Yii::t('staff','staff_member'),
            'dep_id'=>Yii::t('staff','dep_id'),

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

		$criteria->compare('staff_id',$this->staff_id);

		$criteria->compare('staff_code',$this->staff_code,true);

		$criteria->compare('staff_name',$this->staff_name,true);

        $criteria->compare('email',$this->email,true);

        $criteria->compare('staff_level',$this->staff_level,true);
        $criteria->compare('staff_member',$this->staff_member,true);

		$criteria->compare('event',$this->event,true);

		$criteria->compare('staff_address',$this->staff_address,true);

		$criteria->compare('phone_number',$this->phone_number,true);
        $criteria->compare('dep_id',$this->dep_id,true);

		$criteria->compare('office',$this->office,true);



		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider('Staff', array(
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
    public function  getStaffTypeName($staff_id)
    {
        $sur_type_name='';
        $staff_type='"staff_type"';
        $data=AppParam::model()->findAll(array( 'condition'=>'par_type='.$staff_id.' and par_name='.$staff_type));
        foreach ($data as $row)
        {
            $sur_type_name=$row['par_value'];
        }
        return $sur_type_name;
    }
    public function  getLevelName($level)
    {
        $sur_type_name='';
        $level_type='"level_type"';
        $data=AppParam::model()->findAll(array( 'condition'=>'par_type='.$level.' and par_name='.$level_type,));
        foreach ($data as $row)
        {
            $sur_type_name=$row['par_value'];
        }
        return $sur_type_name;
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