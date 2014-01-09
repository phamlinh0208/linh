<h1><?php echo Yii::t('dictionary','competitor_survey') ?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'depcompetitor-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
        array(
            'header'=>'STT',
            'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        ),
        array(
            'name'=>'dep_id',
            'value'=>'$data->getDepartmenttName($data->dep_id?$data->dep_id:-1)',
            'type'=>'raw',
        ),
        array(
            'name'=>'competitor_id',
            'value'=>'$data->getCompetitorName($data->competitor_id?$data->competitor_id:-1)',
            'type'=>'raw',
        ),
		array(
            'header'=>Yii::t('posm','product_id'),
            'value'=>'$data->getProductFromCompetitor($data->competitor_id?$data->competitor_id:-1)',
        ),
		'current_quantity',
        array(
            'name'=>'state',
            'value'=>'$data->getStateName($data->state)',
            'type'=>'raw',
        ),
        array(
            'name'=>'status',
            'value'=>'$data->getStatusName($data->status)',
            'type'=>'raw',
        ),
		'note',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
