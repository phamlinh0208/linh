<h1><?php echo Yii::t('feedback','feedback_manager') ?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'feedback-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'header'=>'STT',
            'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        ),

        array(
            'name'=>'user_id',
            'value'=>'$data->getUserName($data->user_id?$data->user_id:-1)',
            'type'=>'raw',
        ),
		'create_datetime',
        array(
            'name'=>'dep_id',
            'value'=>'$data->getDepartmenttName($data->dep_id?$data->dep_id:-1)',
            'type'=>'raw',
        ),
/*
        array(
            'name'=>'product_id',
            'value'=>'$data->getProductName($data->product_id?$data->product_id:-1)',
            'type'=>'raw',
        ),
*/
        array(
            'name'=>'rating',
            'value'=>'$data->getSatisfactionName($data->rating)',
            'type'=>'raw',
        ),


		'feedback_product',
		'feedback_other',
'next_time',
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
            'url'=>array('/Feedback/exportFeedback'),
        ),

    )
));
?>
