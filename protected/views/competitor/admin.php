<?php

$this->widget('zii.widgets.CMenu', array(
    'firstItemCssClass'=>'first',
    'lastItemCssClass'=>'last',
    'htmlOptions'=>array('class'=>'actions'),
    'items'=>array(

        array(
            'label'=>Yii::t('dictionary', 'create_competitor'),
            'url'=>array('/Competitor/create'),
        ),

    )
));
?>
<br/>
<h1><?php echo Yii::t('dictionary','competitor_manager') ?></h1>
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
	'id'=>'competitor-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'header'=>'STT',
            'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        ),

        array(
            'name'=>'product_id',
            'value'=>'$data->getProductName($data->product_id?$data->product_id:-1)',
            'type'=>'raw',
        ),
		'category',

		//'image',

		'description',

		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
