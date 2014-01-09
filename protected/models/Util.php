<?php

/**
 * This is the model class for table "survey_type".
 *
 * The followings are the available columns in table 'survey_type':
 * @property integer $sur_type_id
 * @property string $sur_type_name
 * @property string $sur_type_status
 * @property string $description
 */
class Util extends CActiveRecord
{
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