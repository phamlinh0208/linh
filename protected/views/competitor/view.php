

<?php 
echo '<h1>'.Yii::t('competitor','view').'</h1>';
echo '<br/>';
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
//		'posm_id',

        array(
            'label' => Yii::t('posm','product_id'),
            'value' => POSM::model()->getProductName($model->product_id?$model->product_id:-1),
        ),
		'category',

		'description',
	),
)); ?>
