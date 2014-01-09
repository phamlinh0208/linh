<?php
$this->breadcrumbs=array(
	'Survey Answers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SurveyAnswer', 'url'=>array('index')),
	array('label'=>'Create SurveyAnswer', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('survey-answer-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Survey Answers</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'survey-answer-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'header'=>'STT',
            'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        ),
		'user_id',
		'sur_id',
		'staff_id',
		'create_datetime',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
