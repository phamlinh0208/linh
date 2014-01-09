<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'app-param-form',
	'enableAjaxValidation'=>false,
)); ?>

	
	<p class="note">Trường <span class="required">*</span> được yêu cầu nhập giá trị.</p>
	
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'par_name'); ?>
		<?php echo $form->textField($model,'par_name',array('size' => 45, 'maxlength' => 200)); ?>
		<?php echo $form->error($model,'par_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'par_type'); ?>
		<?php echo $form->textField($model,'par_type',array('size' => 45, 'maxlength' => 3)); ?>
		<?php echo $form->error($model,'par_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'par_value'); ?>
		<?php echo $form->textField($model,'par_value',array('size' => 45, 'maxlength' => 100)); ?>
		<?php echo $form->error($model,'par_value'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'par_status'); ?>
		<?php echo $form->dropDownList($model, 'par_status', appParam::model()->getStatusOptions()); ?>
		<?php echo $form->error($model,'par_status'); ?>
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