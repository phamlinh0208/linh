

<?php 
echo '<h1>'.Yii::t('product','view').'</h1>';
echo '<br/>';
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'product_id',
		'product_name',
		'product_code',
		'price',
        array(
            'label' => Yii::t('product','status'),
            'value' => Product::model()->getStatusName($model->status?$model->status:0),
        ),
		'description',
	),
)); ?>
