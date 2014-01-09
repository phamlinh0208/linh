<?php

/**
 * This is the model class for table "dep_posm".
 *
 * The followings are the available columns in table 'dep_posm':
 * @property integer $id
 * @property integer $dep_id
 * @property integer $posm_id
 * @property integer $current_quantity
 * @property string $status
 * @property string $state
 */
class DepPosm extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return DepPosm the static model class
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
		return 'dep_posm';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dep_id, posm_id, current_quantity, status, state, create_date', 'required'),
			array('dep_id, posm_id, current_quantity', 'numerical', 'integerOnly'=>true),
			array('status, state', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, dep_id, posm_id, current_quantity, status, state, create_date', 'safe', 'on'=>'search'),
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
			'posm' => array(self::BELONGS_TO, 'Posm', 'posm_id'),
			'dep' => array(self::BELONGS_TO, 'Department', 'dep_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('posm_dep', 'id'),
			'dep_id' => Yii::t('posm_dep', 'dep_id'),
			'posm_id' => Yii::t('posm_dep', 'posm_id'),
			'current_quantity' => Yii::t('posm_dep', 'current_quantity'),
			'status' => Yii::t('posm_dep', 'status'),
			'state' => Yii::t('posm_dep', 'state'),
			'create_date' => "Ngày tạo",			
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

		$criteria->compare('dep_id',$this->dep_id);

		$criteria->compare('posm_id',$this->posm_id);

		$criteria->compare('current_quantity',$this->current_quantity);

		$criteria->compare('status',$this->status,true);

		$criteria->compare('state',$this->state,true);
		
		$criteria->compare('create_date',$this->create_date,true);

		return new CActiveDataProvider('DepPosm', array(
			'criteria'=>$criteria,
		));
	}
    public function getStatusOptions()
    {
        return array('0' => Yii::t('posm', 'disable'), '1' => Yii::t('posm', 'enable'));
    }

    public function getStatusName($status)
    {
        if ($status == 0)
            return Yii::t('posm', 'disable');
        else if ($status == 1)
            return Yii::t('posm', 'enable');
        else
            return $status;
    }

    public function getStateOptions()
    {
        return array('0' => Yii::t('posm', 'old'),
            '1' => Yii::t('posm', 'new'),
            '2' => Yii::t('posm', 'good'),
            '3' => Yii::t('posm', 'change'),
        );
    }

    public function getStateName($status)
    {
        if ($status == 0)
            return Yii::t('posm', 'old');
        else if ($status == 1)
            return Yii::t('posm', 'new');

        else if ($status == 2)
            return Yii::t('posm', 'good');
        else
            return Yii::t('posm', 'change');
    }

    public function  getProductName($product_id)
    {
        $product_name = '';
        $data = Product::model()->findAll(array('condition' => 'product_id=' . $product_id,));
        foreach ($data as $row) {
            $product_name = $row['product_name'];
        }
        return $product_name;
    }
    public function  getDepartmenttName($dep_id)
    {
        $dep_name = '';
        $data = Department::model()->findAll(array('condition' => 'dep_id=' . $dep_id,));
        foreach ($data as $row) {
            $dep_name = $row['dep_name'];
        }
        return $dep_name;
    }
    public function  getPosmName($posm_id)
    {
        $posm_name = '';
        $data = POSM::model()->findAll(array('condition' => 'posm_id=' . $posm_id,));
        foreach ($data as $row) {
            $posm_name = $row['category'];
        }
        return $posm_name;
    }
	public function  getProductFromPOSM($posm_id)
    {
        $product_name = '';
        $data = POSM::model()->findAll(array('condition' => 'posm_id=' . $posm_id,));
        foreach ($data as $row) {
            $product_id = $row['product_id'];
			$dataProduct = Product::model()->findAll(array('condition' => 'product_id=' . $product_id,));
			foreach ($dataProduct as $product) {
				$product_name=$product['product_name'];
			}
        }
        return $product_name;
    }
}