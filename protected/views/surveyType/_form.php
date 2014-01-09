<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'survey-type-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'sur_type_name'); ?>
		<?php echo $form->textField($model,'sur_type_name',array('size' => 45, 'maxlength' => 200)); ?>
		<?php echo $form->error($model,'sur_type_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sur_type_status'); ?>
        <?php echo $form->dropDownList($model, 'sur_type_status', surveyType::model()->getStatusOptions()); ?>
		<?php echo $form->error($model,'sur_type_status'); ?>
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