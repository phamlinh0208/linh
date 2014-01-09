

<h1>Chi tiết kết quả khảo sát POSM</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
	//	'id',
        array(
            'label' => Yii::t('posm_dep','dep_id'),
            'value' => DepPosm::model()->getDepartmenttName($model->dep_id?$model->dep_id:-1),
        ),
        array(
            'label' => Yii::t('posm_dep','posm_id'),
            'value' => DepPosm::model()->getPosmName($model->posm_id?$model->posm_id:-1),
        ),
		'current_quantity',
        array(
            'label' => Yii::t('posm_dep','status'),
            'value' => DepPosm::model()->getStatusName($model->status?$model->status:0),
        ),

        array(
            'label' => Yii::t('posm_dep','state'),
            'value' => DepPosm::model()->getStateName($model->state?$model->state:0),
        ),
	),
)); ?>
