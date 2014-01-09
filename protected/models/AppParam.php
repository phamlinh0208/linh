<?php
/**
 * This is the model class for table "app_param".
 *
 * The followings are the available columns in table 'app_param':
 * @property integer $id
 * @property string $par_name
 * @property string $par_type
 * @property string $par_value
 * @property string $par_status
 * @property string $description
 */
class AppParam extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return AppParam the static model class
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
		return 'app_param';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('par_name, par_type, par_value', 'required'),
			array('par_type', 'length', 'max'=>3),
			array('par_value', 'length', 'max'=>100),
			array('par_status', 'length', 'max'=>1),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, par_name, par_type, par_value, par_status, description', 'safe', 'on'=>'search'),
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
			'id' => 'Id',
			'par_name' => Yii::t('app_param','par_name'),
			'par_type' => Yii::t('app_param','par_type'),
			'par_value' => Yii::t('app_param','par_value'),
			'par_status' => Yii::t('app_param','par_status'),
			'description' => Yii::t('app_param','description'),
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

		$criteria->compare('par_name',$this->par_name,true);

		$criteria->compare('par_type',$this->par_type,true);

		$criteria->compare('par_value',$this->par_value,true);

		$criteria->compare('par_status',$this->par_status,true);

		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider('AppParam', array(
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