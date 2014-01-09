<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ans_id'); ?>
		<?php echo $form->textField($model,'ans_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'question_id'); ?>
		<?php echo $form->textField($model,'question_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ans_text'); ?>
		<?php echo $form->textArea($model,'ans_text',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ans_yn'); ?>
		<?php echo $form->textField($model,'ans_yn'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ans_status'); ?>
		<?php echo $form->textField($model,'ans_status',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->