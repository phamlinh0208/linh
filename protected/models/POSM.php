<?php

/**
 * This is the model class for table "posm".
 *
 * The followings are the available columns in table 'posm':
 * @property integer $posm_id
 * @property integer $product_id
 * @property string $category
 * @property integer $quantity
 * @property integer $image
 * @property string $description
 */
class POSM extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return POSM the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'posm';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('product_id, category, quantity', 'required'),
            array('product_id, quantity, image', 'numerical', 'integerOnly' => true),
            array('status', 'length', 'max' => 1),
            array('description', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('posm_id, product_id, category, quantity, image, description', 'safe', 'on' => 'search'),
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
            'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
            'department' => array(self::BELONGS_TO, 'Department', 'dep_id'),
            'dep_posm' => array(self::HAS_MANY, 'DepPosm', 'posm_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'posm_id' => Yii::t('posm', 'posm_id'),
            'dep_id' => Yii::t('posm', 'dep_id'),
            'product_id' => Yii::t('posm', 'product_id'),
            'category' => Yii::t('posm', 'category'),
            'quantity' => Yii::t('posm', 'quantity'),
            'status' => Yii::t('posm', 'status'),
            'state' => Yii::t('posm', 'state'),
            'image' => Yii::t('posm', 'image'),
            'description' => Yii::t('posm', 'description'),
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

        $criteria = new CDbCriteria;

        $criteria->compare('posm_id', $this->posm_id);
        $criteria->compare('product_id', $this->product_id);

        $criteria->compare('category', $this->category, true);

        $criteria->compare('quantity', $this->quantity);


        $criteria->compare('image', $this->image);

        $criteria->compare('description', $this->description, true);

        return new CActiveDataProvider('POSM', array(
            'criteria' => $criteria,
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
}