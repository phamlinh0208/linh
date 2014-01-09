<?php

/**
 * This is the model class for table "area".
 *
 * The followings are the available columns in table 'area':
 * @property integer $area_id
 * @property string $area_code
 * @property string $area_name
 * @property integer $area_parent_id
 * @property string $area_full_name
 * @property string $description
 */
class Area extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Area the static model class
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
		return 'area';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('area_code, area_name', 'required'),
			array('area_parent_id', 'numerical', 'integerOnly'=>true),
			array('area_full_name, description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('area_id, area_code, area_name, area_parent_id, area_full_name, description', 'safe', 'on'=>'search'),
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
			'departments' => array(self::HAS_MANY, 'Department', 'area_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'area_id' =>  Yii::t('area','area_id'),
			'area_code' =>  Yii::t('area','area_code'),
			'area_name' =>  Yii::t('area','area_name'),
			'area_parent_id' =>  Yii::t('area','area_parent_id'),
			'area_full_name' => Yii::t('area','area_full_name'),
			'description' => Yii::t('area','description'),
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

		$criteria->compare('area_id',$this->area_id);

		$criteria->compare('area_code',$this->area_code,true);

		$criteria->compare('area_name',$this->area_name,true);

		$criteria->compare('area_parent_id',$this->area_parent_id);

		$criteria->compare('area_full_name',$this->area_full_name,true);

		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider('Area', array(
			'criteria'=>$criteria,
		));
	}
    public function getParentAreaName($area_parent_id)
    {
        $area_parent_name='';
        $data=Area::model()->findAll(array( 'condition'=>'area_id='.$area_parent_id,));
        foreach ($data as $row)
        {
            $area_parent_name=$row['area_name'];
        }
        return $area_parent_name;
    }
}