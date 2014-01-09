<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'answer-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'question_id'); ?>
        <?php echo $form->dropDownList($model,'question_id',CHtml::listData(Question::model()->findAll(array( 'condition'=>'status=1',)), 'question_id', 'question_text')); ?>
		<?php echo $form->error($model,'question_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ans_text'); ?>
        <?php echo $form->textField($model,'ans_text',array('size' => 45, 'maxlength' => 200)); ?>
		<?php echo $form->error($model,'ans_text'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ans_yn'); ?>
        <?php echo $form->dropDownList($model,'ans_yn',Answer::model()->getYesNoOptions()); ?>
		<?php echo $form->error($model,'ans_yn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ans_status'); ?>
        <?php echo $form->dropDownList($model,'ans_status',Answer::model()->getStatusOptions()); ?>
		<?php echo $form->error($model,'ans_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
        <?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>45)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->