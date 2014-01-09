<?php

$this->widget('zii.widgets.CMenu', array(
    'firstItemCssClass'=>'first',
    'lastItemCssClass'=>'last',
    'htmlOptions'=>array('class'=>'actions'),
    'items'=>array(

        array(
            'label'=>Yii::t('area', 'create_area'),
            'url'=>array('/Area/create'),
        ),

    )
));
?>
<br/>
<h1><?php echo Yii::t('area','area_manager') ?></h1>
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
	'id'=>'area-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'header'=>'STT',
            'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        ),
		'area_code',
		'area_name',
        array(
            'name'=>'area_parent_id',
            'value'=>'$data->getParentAreaName($data->area_parent_id?$data->area_parent_id:-1)',
            'type'=>'raw',
        ),
		'area_full_name',
		'description',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
