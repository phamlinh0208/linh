<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'staff_id'); ?>
		<?php echo $form->textField($model,'staff_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'staff_code'); ?>
		<?php echo $form->textArea($model,'staff_code',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'staff_name'); ?>
		<?php echo $form->textArea($model,'staff_name',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'staff_full_name'); ?>
		<?php echo $form->textArea($model,'staff_full_name',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'staff_address'); ?>
		<?php echo $form->textArea($model,'staff_address',array('rows'=>6, 'cols'=>50)); ?>
	</div>

    <div class="row">
        <?php echo $form->label($model,'staff_level'); ?>
        <?php echo $form->textArea($model,'staff_level',array('rows'=>6, 'cols'=>50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'email'); ?>
        <?php echo $form->textArea($model,'email',array('rows'=>6, 'cols'=>50)); ?>
    </div>

	<div class="row">
		<?php echo $form->label($model,'phone_number'); ?>
		<?php echo $form->textArea($model,'phone_number',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'member_type'); ?>
		<?php echo $form->textArea($model,'member_type',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'staff_contact'); ?>
		<?php echo $form->textArea($model,'staff_contact',array('rows'=>6, 'cols'=>50)); ?>
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