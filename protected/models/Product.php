<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $product_id
 * @property string $product_name
 * @property string $product_code
 * @property string $product_type
 * @property double $price
 * @property string $status
 * @property string $description
 */
class Product extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Product the static model class
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
		return 'product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_name, product_code, price', 'required'),
			array('price', 'numerical'),
			array('status', 'length', 'max'=>1),
			array('description,product_type', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('product_id, product_name,product_type, product_code, price, status, description', 'safe', 'on'=>'search'),
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
			'posms' => array(self::HAS_MANY, 'Posm', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'product_id' => Yii::t('product','product_id'),
			'product_name' => Yii::t('product','product_name'),
			'product_code' => Yii::t('product','product_code'),
			'price' => Yii::t('product','price'),
			'status' => Yii::t('product','status'),
			'description' => Yii::t('product','description'),
			'product_type'=>'Loại sản phẩm',
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

		$criteria->compare('product_id',$this->product_id);

		$criteria->compare('product_name',$this->product_name,true);

		$criteria->compare('product_code',$this->product_code,true);

		$criteria->compare('price',$this->price);
		$criteria->compare('product_type',$this->product_type,true);
		$criteria->compare('status',$this->status,true);

		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider('Product', array(
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
	public function getProductTypeOptions(){
        return array('0' => 'POSM', '1' => 'Competitor');
    }
    public function getProductTypeName($status)
    {
        if($status==0)
            return 'POSM';
        else if($status==1)
            return 'Competitor';
        else
            return $status;
    }
}