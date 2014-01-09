<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'competitor-form',
	'enableAjaxValidation'=>false,
)); ?>

	

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'product_id'); ?>
        <?php echo $form->dropDownList($model,'product_id',CHtml::listData(Product::model()->findAll(array( 'condition'=>' product_type=1',)), 'product_id', 'product_name')); ?>
		<?php echo $form->error($model,'product_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'category'); ?>
        <?php echo $form->textField($model,'category',array('size' => 45, 'maxlength' => 200)); ?>
		<?php echo $form->error($model,'category'); ?>
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