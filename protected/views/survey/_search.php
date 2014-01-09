<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'sur_id'); ?>
		<?php echo $form->textField($model,'sur_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sur_name'); ?>
		<?php echo $form->textArea($model,'sur_name',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'create_datetime'); ?>
		<?php echo $form->textField($model,'create_datetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sur_type_id'); ?>
		<?php echo $form->textField($model,'sur_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sur_status'); ?>
		<?php echo $form->textField($model,'sur_status',array('size'=>1,'maxlength'=>1)); ?>
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