<?php

/**
 * This is the model class for table "department".
 *
 * The followings are the available columns in table 'department':
 * @property integer $dep_id
 * @property string $dep_name
 * @property string $dep_code
 * @property string $dep_address
 * @property string $precinct
 *  @property string $district
 *  @property string $province
 * @property integer $number_chair
 * @property integer $dep_status
 * @property string $description
 * @property string $dien_tich
 * @property integer $phong_khach
 * @property string $work_time
 */
class Department extends CActiveRecord
{
    public $doctor_name;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Department the static model class
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
		return 'department';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dep_name, number_chair,dien_tich,phong_khach', 'required'),
			array('number_chair, dep_status,phong_khach', 'numerical', 'integerOnly'=>true),
			array('description, dep_address,doctors.name, precinct,district,province,dep_code,work_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('dep_id, dep_name, dien_tich,phong_khach,doctors.name,doctor_name,dep_code,work_time, dep_address,  precinct,district,province, number_chair, dep_status, description', 'safe', 'on'=>'search'),
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
            'images' => array(self::HAS_MANY, 'Image', 'dep_id'),
            'doctors' => array(self::HAS_MANY, 'Doctor', 'dep_id'),
            'posm' => array(self::HAS_MANY, 'POSM', 'dep_id'),
			'staffs' => array(self::HAS_MANY, 'Staff', 'dep_id'),
            'dep_posm' => array(self::HAS_MANY, 'DepPosm', 'dep_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'dep_id' =>  Yii::t('department','dep_id'),
			'dep_name' => Yii::t('department','dep_name'),
			'dep_address' =>  Yii::t('department','dep_address'),
			'precinct' =>  Yii::t('department','precinct'),
            'district' =>  Yii::t('department','district'),
            'province' =>  Yii::t('department','province'),
			'number_chair' => Yii::t('department','number_chair'),
			'dep_status' =>  Yii::t('department','dep_status'),
			'description' =>  Yii::t('department','description'),
            'dien_tich' =>  Yii::t('department','dien_tich'),
            'phong_khach' =>  Yii::t('department','phong_khach'),
			'dep_code'=>'Mã phòng nha',
			'work_time'=>'Thời gian làm việc'
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

		$criteria->compare('dep_name',$this->dep_name,true);

		$criteria->compare('dep_address',$this->dep_address,true);

		$criteria->compare('district',$this->district,true);
        $criteria->compare('precinct',$this->precinct,true);
        $criteria->compare('province',$this->province,true);
		$criteria->compare('number_chair',$this->number_chair);
		$criteria->compare('dep_code',$this->dep_code);
		$criteria->compare('dep_status',$this->dep_status);

		$criteria->compare('description',$this->description,true);
        $criteria->compare('dien_tich',$this->dien_tich,true);
        $criteria->compare('phong_khach',$this->phong_khach,true);
		 $criteria->compare('work_time',$this->work_time,true);
		return new CActiveDataProvider('Department', array(
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
    public function  getParentDepartmentName($parent_dep_id)
    {
        $parent_dep_name='';
        $data=Department::model()->findAll(array( 'condition'=>'parent_dep_id='.$parent_dep_id?$parent_dep_id:-1,));
        foreach ($data as $row)
        {
            $parent_dep_name=$row['dep_name'];
        }
        return $parent_dep_name;
    }
    public function  getDepartmentName($dep_id)
    {
        $dep_name='';
        $data=Department::model()->findAll(array( 'condition'=>'dep_id='.$dep_id?$dep_id:-1,));
        foreach ($data as $row)
        {
            $dep_name=$row['dep_name'];
        }
        return $dep_name;
    }
    public function  getAreaName($area_id)
    {
        $area_name ='';
        $data=Area::model()->findAll(array( "condition"=>"area_id='".($area_id?$area_id:-1)."'",));
        foreach ($data as $row)
        {
            $area_name=$row['area_name'];
        }
        return $area_name;
    }
    public function  getDeparmentTypeName($dep_type_id)
    {
        $dep_type_name='';
        $dep_type='"dep_type"';
        $data=AppParam::model()->findAll(array( 'condition'=>'par_type='.$dep_type_id.' and par_name='.$dep_type));
        foreach ($data as $row)
        {
            $dep_type_name=$row['par_value'];
        }
        return $dep_type_name;
    }
    public function getYesNoOptions(){
        return array('0' => Yii::t('dictionary','do not have'), '1' => Yii::t('dictionary','have'));
    }
    public function getYesNoName($yn)
    {
        if($yn==0)
            return Yii::t('dictionary','do not have');
        else if($yn==1)
            return Yii::t('dictionary','have');
        else
            return $yn;
    }
    public function  getChair($chair)
    {
        $chair_value='';
        $type='"dep_chair"';
        $data=AppParam::model()->findAll(array( 'condition'=>'par_type='.$chair.' and par_name='.$type));
        foreach ($data as $row)
        {
            $chair_value=$row['par_value'];
        }
        return $chair_value;
    }
    public function  getDienTich($dt)
    {
        $Dientich_value='';
        $type='"dep_dt"';
        $data=AppParam::model()->findAll(array( 'condition'=>'par_type='.$dt.' and par_name='.$type));
        foreach ($data as $row)
        {
            $Dientich_value=$row['par_value'];
        }
        return $Dientich_value;
    }
	public static function  convertDepCode($province,$chair,$dep_name)
    {
         $code='';
		 $words = preg_split("/\s+/", $dep_name);
		 foreach ($words as $w) {
		  $nameFirst .= strtoupper($w[0]);
		 }
		 $words = preg_split("/\s+/", $province);
		 foreach ($words as $w) {
		  $provinceFirst .= strtoupper($w[0]);
		 }
		 $code= $nameFirst.$chair.$provinceFirst;
		 return $code;
    }
	public  static function  getChairFromAppParam($chair)
    {
        $chair_value='';
        $type='"dep_chair"';
        $data=AppParam::model()->findAll(array( 'condition'=>'par_type='.$chair.' and par_name='.$type));
        foreach ($data as $row)
        {
            $chair_value=$row['par_value'];
        }
        return $chair_value;
    }
}