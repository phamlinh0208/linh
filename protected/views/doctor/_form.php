<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'doctor-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textArea($model,'name',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textArea($model,'email',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone_number'); ?>
		<?php echo $form->textArea($model,'phone_number',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'phone_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fax'); ?>
		<?php echo $form->textArea($model,'fax',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'fax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'office'); ?>
		<?php echo $form->textArea($model,'office',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'office'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'member_type'); ?>
		<?php echo $form->textField($model,'member_type'); ?>
		<?php echo $form->error($model,'member_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'event_type'); ?>
		<?php echo $form->textField($model,'event_type'); ?>
		<?php echo $form->error($model,'event_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dep_id'); ?>
		<?php echo $form->textField($model,'dep_id'); ?>
		<?php echo $form->error($model,'dep_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->