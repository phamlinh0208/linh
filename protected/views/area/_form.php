<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'area-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'area_code'); ?>
        <?php echo $form->textField($model,'area_code',array('size' => 45, 'maxlength' => 200)); ?>
		<?php echo $form->error($model,'area_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'area_name'); ?>
        <?php echo $form->textField($model,'area_name',array('size' => 45, 'maxlength' => 200)); ?>
		<?php echo $form->error($model,'area_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'area_parent_id'); ?>
        <?php echo $form->dropDownList($model,'area_parent_id',CHtml::listData(Area::model()->findAll(), 'area_id', 'area_name'),array('empty' => '')); ?>
		<?php echo $form->error($model,'area_parent_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'area_full_name'); ?>
        <?php echo $form->textField($model,'area_full_name',array('size' => 45, 'maxlength' => 200)); ?>
		<?php echo $form->error($model,'area_full_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
        <?php echo $form->textField($model,'description',array('size' => 45, 'maxlength' => 200)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->