<?php
$this->breadcrumbs=array(
//	'Questions'=>array('index'),
//	'Manage',
);

$this->widget('zii.widgets.CMenu', array(
    'firstItemCssClass'=>'first',
    'lastItemCssClass'=>'last',
    'htmlOptions'=>array('class'=>'actions'),
    'items'=>array(

        array(
            'label'=>Yii::t('question', 'create_question'),
            'url'=>array('/question/create'),
        ),

    )
));
?>
<br/>
<h1><?php echo Yii::t('question','question_manager') ?></h1>

<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('question-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php // echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'question-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'header'=>'STT',
            'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        ),
		'question_text',
		array(
            'name'=>'sur_id',
            'value'=>'$data->getSurveyName($data->sur_id)',
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
