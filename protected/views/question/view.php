<?php
$this->breadcrumbs=array(
	'Questions'=>array('index'),
	$model->question_id,
);


?>

<h1> <?php

    echo Yii::t('question','view_detail').': '. $model->question_text; ?></h1>

<?php
    $question=$model->searchQuestion();
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'question-grid',
    'dataProvider'=>$question,
    'columns'=>array(
        array(
            'name'=>'',
            'type'=>'html',
            'value'=>'$row + 1',
        ),

        array(
            'name'=>'question_text',
            'type'=>'html',
            'value'=>'$data->question_text',
        ),
        array(
            'name'=>'sur_id',
            'type'=>'raw',
            'value'=>'$data->getSurveyName($data->sur_id)',
        ),
        array(
            'name'=>'status',
            'value'=>'$data->getStatusName($data->status)',
            'type'=>'raw',
        ),
        'description',
    ),
));
?>

<div>
    <?php
    $answerAnswer = $model->searchAnswer();
    $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'answer-grid',
        'dataProvider'=>$answerAnswer,
        'columns'=>array(
            array(
                'name'=>'',
                'type'=>'html',
                'value'=>'$row + 1',
            ),

            array(
                'name'=>'ans_text',
                'type'=>'html',
                'value'=>'$data->ans_text',
            ),
//            array(
//                'name'=>'ans_yn',
//                'value'=>'$data->getYesNoName($data->ans_yn)',
//                'type'=>'raw',
//            ),
            array(
                'name'=>'ans_status',
                'value'=>'$data->getStatusName($data->ans_status)',
                'type'=>'raw',
            ),
        ),
    )); ?>
</div>