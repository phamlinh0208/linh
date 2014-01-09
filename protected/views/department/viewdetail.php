<?php
echo Yii::t('department','doctor_img');
echo '<br/>';
echo CHtml::image(Yii::app()->request->baseUrl."/images/doctor/".$model["bs_img"], "", array("width"=>240));
echo '<br/>';

echo Yii::t('department','doctor_name').':'.$model['bs_name'];
echo '<br/>';
echo Yii::t('department','doctor_email').':'.$model['bs_email'];
echo '<br/>';
echo Yii::t('department','doctor_phone').':'.$model['bs_phone'];
echo '<br/>';
echo Yii::t('department','doctor_office').':'.$model['bs_office'];
echo '<br/>';
echo Yii::t('department','doctor_event').':'.$model['bs_event'];
echo '<br/>';
echo Yii::t('department','doctor_member').':'.$model['bs_member'];
echo '<br/>';
echo Yii::t('department','doctor_dep').':'.$model['dep_name'];
echo '<br/>';
echo Yii::t('department','img_dep');
echo '<br/>';
foreach ($images as $image)
{
	echo CHtml::image(Yii::app()->request->baseUrl."/images/department/".$image["img_url"], "", array("width"=>240));
}

?>

