<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'survey-answer-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sur_id'); ?>
		<?php echo $form->textField($model,'sur_id'); ?>
		<?php echo $form->error($model,'sur_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'staff_id'); ?>
		<?php echo $form->textField($model,'staff_id'); ?>
		<?php echo $form->error($model,'staff_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_datetime'); ?>
		<?php echo $form->textField($model,'create_datetime'); ?>
		<?php echo $form->error($model,'create_datetime'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->