

<h1><?php echo Yii::t('feedback','view');?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
        array(
            'label' => Yii::t('feedback','user_id'),
            'value' => Feedback::model()->getUserName($model->user_id?$model->user_id:-1),
        ),
		'create_datetime',
        array(
            'label' => Yii::t('posm_dep','dep_id'),
            'value' => Feedback::model()->getDepartmenttName($model->dep_id?$model->dep_id:-1),
        ),
        array(
            'label' => Yii::t('feedback','product_id'),
            'value' => Feedback::model()->getProductName($model->product_id?$model->product_id:-1),
        ),
		array(
            'label' => Yii::t('feedback','rating'),
            'value' => Feedback::model()->getSatisfactionName($model->rating),
        ),
		'feedback_product',
		'feedback_other',
	),
)); ?>
