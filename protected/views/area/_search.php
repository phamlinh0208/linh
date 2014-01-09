<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'area_id'); ?>
		<?php echo $form->textField($model,'area_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'area_code'); ?>
		<?php echo $form->textArea($model,'area_code',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'area_name'); ?>
		<?php echo $form->textArea($model,'area_name',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'area_parent_id'); ?>
		<?php echo $form->textField($model,'area_parent_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'area_full_name'); ?>
		<?php echo $form->textArea($model,'area_full_name',array('rows'=>6, 'cols'=>50)); ?>
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