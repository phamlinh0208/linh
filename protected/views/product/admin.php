<?php

$this->widget('zii.widgets.CMenu', array(
    'firstItemCssClass'=>'first',
    'lastItemCssClass'=>'last',
    'htmlOptions'=>array('class'=>'actions'),
    'items'=>array(

        array(
            'label'=>Yii::t('product', 'create_product'),
            'url'=>array('/Product/create'),
        ),

    )
));
?>
<br/>
<h1><?php echo Yii::t('dictionary','product_list') ?></h1>
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
	'id'=>'product-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'header'=>'STT',
            'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        ),
		'product_name',
		'product_code',
		'price',
		array(
            'name'=>'product_type',
            'value'=>'$data->getProductTypeName($data->product_type)',
            'type'=>'raw',
        ),
        array(
            'name'=>'status',
            'value'=>'$data->getStatusName($data->status)',
            'type'=>'raw',
        ),
		'description',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
