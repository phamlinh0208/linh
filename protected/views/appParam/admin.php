<?php

$this->widget('zii.widgets.CMenu', array(
    'firstItemCssClass'=>'first',
    'lastItemCssClass'=>'last',
    'htmlOptions'=>array('class'=>'actions'),
    'items'=>array(

        array(
            'label'=>Yii::t('app_param', 'create_param'),
            'url'=>array('/AppParam/create'),
        ),

    )
));
?>
<br/>
<h1><?php echo Yii::t('app_param','param_manager') ?></h1>
<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('area-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'app-param-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'header'=>'STT',
            'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        ),
		'par_name',
		'par_type',
		'par_value',
		array(
			'name'=>'par_status',
			'value'=>'$data->getStatusName($data->par_status)',
			'type'=>'raw',
		),
		'description',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
