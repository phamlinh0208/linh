<h1><?php echo Yii::t('posm_dep','survey_posm_manager') ?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'dep-posm-grid',
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
            'name'=>'posm_id',
            'value'=>'$data->getPosmName($data->posm_id?$data->posm_id:-1)',
            'type'=>'raw',
        ),
		 array(
            'header'=>Yii::t('posm','product_id'),
            'value'=>'$data->getProductFromPOSM($data->posm_id?$data->posm_id:-1)',
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
        array(
            'name'=>'create_time',
            'value'=>'$data->create_date',
            'type'=>'raw',
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
<?php

$this->widget('zii.widgets.CMenu', array(
    'firstItemCssClass'=>'first',
    'lastItemCssClass'=>'last',
    'htmlOptions'=>array('class'=>'actions'),
    'items'=>array(

        array(
            'label'=>Yii::t('feedback', 'export_data'),
            'url'=>array('/DepPosm/exportPosm'),
        ),

    )
));
?>