<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-form',
	'enableAjaxValidation'=>false,
)); ?>

	

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'product_name'); ?>
        <?php echo $form->textField($model,'product_name',array('size' => 45, 'maxlength' => 200)); ?>
		<?php echo $form->error($model,'product_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'product_code'); ?>
        <?php echo $form->textField($model,'product_code',array('size' => 45, 'maxlength' => 200)); ?>
		<?php echo $form->error($model,'product_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
        <?php echo $form->textField($model,'price',array('size' => 45, 'maxlength' => 200)); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>
<div class="row">
		<?php echo $form->labelEx($model,'product_type'); ?>
        <?php echo $form->dropDownList($model,'product_type',Product::model()->getProductTypeOptions()); ?>
		<?php echo $form->error($model,'product_type'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
        <?php echo $form->dropDownList($model,'status',Product::model()->getStatusOptions()); ?>
		<?php echo $form->error($model,'status'); ?>
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