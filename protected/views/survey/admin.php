<?php
$this->breadcrumbs=array(
//	'Surveys'=>array('index'),
//	'Manage',
);

$this->widget('zii.widgets.CMenu', array(
    'firstItemCssClass'=>'first',
    'lastItemCssClass'=>'last',
    'htmlOptions'=>array('class'=>'actions'),
    'items'=>array(

        array(
            'label'=>Yii::t('survey', 'create_survey'),
            'url'=>array('/survey/create'),
        ),

    )
));
?>
<br/>
<h1><?php echo Yii::t('survey','survey_manager') ?></h1>

<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('survey-grid', {
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
	'id'=>'survey-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
        array(
            'header'=>'STT',
            'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        ),
		'sur_name',
		'create_datetime',
        array(
            'name'=>'sur_type_id',
            'value'=>'$data->getSurveyTypeName($data->sur_type_id)',
            'type'=>'raw',
        ),

        array(
            'name'=>'sur_status',
            'value'=>'$data->getStatusName($data->sur_status)',
            'type'=>'raw',
        ),
		'description',
        array(
            'name'  => '',
            'value' => 'CHtml::link("Export", Yii::app()->createUrl("Survey/ExportExcel",array("sur_id"=>$data["sur_id"])))',
            'type'  => 'raw',
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
