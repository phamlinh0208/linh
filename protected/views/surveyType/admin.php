<?php
$this->breadcrumbs=array(
//	'Survey Types'=>array('index'),
//	'Manage',
);

$this->widget('zii.widgets.CMenu', array(
    'firstItemCssClass'=>'first',
    'lastItemCssClass'=>'last',
    'htmlOptions'=>array('class'=>'actions'),
    'items'=>array(

        array(
            'label'=>Yii::t('survey_type', 'create_sur_type'),
            'url'=>array('/surveyType/create'),
        ),

    )
));

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('survey-type-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<br/>
<h1><?php echo Yii::t('survey_type','sur_type_manager') ?></h1>


<?php // echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'survey-type-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'header'=>'STT',
            'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        ),
		'sur_type_name',

        array(
            'name'=>'sur_type_status',
            'value'=>'$data->getStatusName($data->sur_type_status)',
            'type'=>'raw',
        ),
		'description',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
