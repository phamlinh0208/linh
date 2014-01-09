
<h1>Chi tiết kết quả khảo sát Competitor</h1>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
        array(
            'label' => Yii::t('posm_dep','dep_id'),
            'value' => Depcompetitor::model()->getDepartmenttName($model->dep_id?$model->dep_id:-1),
        ),
        array(
            'label' => Yii::t('dictionary','competitor'),
            'value' => Depcompetitor::model()->getCompetitorName($model->competitor_id?$model->competitor_id:-1),
        ),
		'current_quantity',
        array(
            'label' => Yii::t('posm_dep','status'),
            'value' => Depcompetitor::model()->getStatusName($model->status?$model->status:0),
        ),

        array(
            'label' => Yii::t('posm_dep','state'),
            'value' => Depcompetitor::model()->getStateName($model->state?$model->state:0),
        ),
		'note'
	),
)); ?>
