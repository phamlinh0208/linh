<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'dep_id'); ?>
		<?php echo $form->textField($model,'dep_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dep_name'); ?>
		<?php echo $form->textArea($model,'dep_name',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dep_type'); ?>
		<?php echo $form->textField($model,'dep_type',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dep_address'); ?>
		<?php echo $form->textArea($model,'dep_address',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dep_contact'); ?>
		<?php echo $form->textArea($model,'dep_contact',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'number_chair'); ?>
		<?php echo $form->textField($model,'number_chair'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'parent_dep_id'); ?>
		<?php echo $form->textField($model,'parent_dep_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'area_id'); ?>
		<?php echo $form->textField($model,'area_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dep_status'); ?>
		<?php echo $form->textField($model,'dep_status'); ?>
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