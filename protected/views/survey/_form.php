<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'survey-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'sur_name'); ?>
		<?php echo $form->textField($model,'sur_name',array('size' => 45, 'maxlength' => 200)); ?>
		<?php echo $form->error($model,'sur_name'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'sur_type_id'); ?>
		<?php echo $form->dropDownList($model,'sur_type_id',CHtml::listData(SurveyType::model()->findAll(array( 'condition'=>'sur_type_status=1',)), 'sur_type_id', 'sur_type_name')); ?>
		<?php echo $form->error($model,'sur_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sur_status'); ?>
		<?php echo $form->dropDownList($model,'sur_status',Survey::model()->getStatusOptions()); ?>
		<?php echo $form->error($model,'sur_status'); ?>
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