<?php

/**
 * This is the model class for table "feedback".
 *
 * The followings are the available columns in table 'feedback':
 * @property integer $id
 * @property integer $user_id
 * @property string $create_datetime
 * @property integer $dep_id
 * @property integer $product_id
 * @property integer $rating
 * @property string $feedback_product
 * @property string $feedback_other
  * @property string $next_time
 */
class Feedback extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Feedback the static model class
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
		return 'feedback';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, create_datetime, dep_id, rating', 'required'),
			array('user_id, dep_id, product_id, rating', 'numerical', 'integerOnly'=>true),
            array('rating,feedback_product,feedback_other,next_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, create_datetime, dep_id, product_id,next_time, rating, feedback_product, feedback_other', 'safe', 'on'=>'search'),
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
			'user_id' => Yii::t('feedback','user_id'),
			'create_datetime' =>  Yii::t('feedback','create_datetime'),
			'dep_id' =>  Yii::t('feedback','dep_id'),
			'product_id' =>  Yii::t('feedback','product_id'),
			'rating' =>  Yii::t('feedback','rating'),
			'feedback_product' =>  Yii::t('feedback','feedback_product'),
			'feedback_other' =>  Yii::t('feedback','feedback_other'),
			'next_time'=>'Lần ghé thăm tiếp theo'
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

		$criteria->compare('user_id',$this->user_id);

		$criteria->compare('create_datetime',$this->create_datetime,true);

		$criteria->compare('dep_id',$this->dep_id);

		$criteria->compare('product_id',$this->product_id);

		$criteria->compare('rating',$this->rating);

		$criteria->compare('feedback_product',$this->feedback_product);

		$criteria->compare('feedback_other',$this->feedback_other);

		return new CActiveDataProvider('Feedback', array(
			'criteria'=>$criteria,
		));
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
    public function  getProductName($product_id)
    {
        $product_name = '';
        $data = Product::model()->findAll(array('condition' => 'product_id=' . $product_id,));
        foreach ($data as $row) {
            $product_name = $row['product_name'];
        }
        return $product_name;
    }
    public function  getUserName($user_id)
    {
        $user_name = '';
        $data = User::model()->findAll(array('condition' => 'id=' . $user_id,));
        foreach ($data as $row) {
            $user_name = $row['username'];
        }
        return $user_name;
    }
    public function getSatisfactionOptions(){
        return array(
            '0' => Yii::t('feedback','satisfaction'),
            '1' => Yii::t('feedback','dis_satisfaction')
        );
    }
    public function getSatisfactionName($status)
    {
        if($status==0)
            return Yii::t('feedback','satisfaction');
        else if($status==1)
            return Yii::t('feedback','dis_satisfaction');
        else
            return $status;
    }
}