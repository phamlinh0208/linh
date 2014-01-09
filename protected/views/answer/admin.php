<?php
$this->breadcrumbs=array(
	//'Answers'=>array('index'),
	//'Manage',
);

$this->widget('zii.widgets.CMenu', array(
    'firstItemCssClass'=>'first',
    'lastItemCssClass'=>'last',
    'htmlOptions'=>array('class'=>'actions'),
    'items'=>array(

        array(
            'label'=>Yii::t('answer', 'create_answer'),
            'url'=>array('/answer/create'),
        ),

    )
));
?>
<br/>
<h1><?php echo Yii::t('answer','answer_manager') ?></h1>

<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('answer-grid', {
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
	'id'=>'answer-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'header'=>'STT',
            'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        ),
        array(
            'name'=>'question_id',
            'value'=>'$data->getQuestionName($data->question_id)',
            'type'=>'raw',
        ),
		'ans_text',
        /*
		array(
            'name'=>'ans_yn',
            'value'=>'$data->getYesNoName($data->ans_yn)',
            'type'=>'raw',
        ),
		*/
        array(
            'name'=>'ans_status',
            'value'=>'$data->getStatusName($data->ans_status)',
            'type'=>'raw',
        ),
		'description',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
