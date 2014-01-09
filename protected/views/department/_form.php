<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'department-form',
	'enableAjaxValidation'=>false,
)); ?>

	
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'dep_name'); ?>
        <?php echo $form->textField($model,'dep_name',array('size' => 45, 'maxlength' => 200)); ?>
		<?php echo $form->error($model,'dep_name'); ?>
	</div>



	<div class="row">
		<?php echo $form->labelEx($model,'dep_address'); ?>
        <?php echo $form->textField($model,'dep_address',array('size' => 45, 'maxlength' => 200)); ?>
		<?php echo $form->error($model,'dep_address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'precinct'); ?>
        <?php echo $form->textField($model,'precinct',array('size' => 45, 'maxlength' => 200)); ?>
		<?php echo $form->error($model,'precinct'); ?>
	</div>
    <div class="row">
        <?php echo $form->labelEx($model,'district'); ?>
        <?php echo $form->textField($model,'district',array('size' => 45, 'maxlength' => 200)); ?>
        <?php echo $form->error($model,'district'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'province'); ?>
        <?php echo $form->textField($model,'province',array('size' => 45, 'maxlength' => 200)); ?>
        <?php echo $form->error($model,'province'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'number_chair'); ?>
        <?php echo $form->dropDownList($model, 'number_chair', CHtml::listData(AppParam::model()->findAll(array('condition' => 'par_name="dep_chair"',)), 'par_type', 'par_value')); ?>
		<?php echo $form->error($model,'number_chair'); ?>
	</div>
    <div class="row">
        <?php echo $form->labelEx($model,'dien_tich'); ?>
        <?php echo $form->dropDownList($model, 'dien_tich', CHtml::listData(AppParam::model()->findAll(array('condition' => 'par_name="dep_dt"',)), 'par_type', 'par_value')); ?>
        <?php echo $form->error($model,'dien_tich'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'phong_khach'); ?>
        <?php echo $form->dropDownList($model,'phong_khach',Department::model()->getYesNoOptions()); ?>
        <?php echo $form->error($model,'phong_khach'); ?>
    </div>


	<div class="row">
		<?php echo $form->labelEx($model,'dep_status'); ?>
        <?php echo $form->dropDownList($model,'dep_status',AppParam::model()->getStatusOptions()); ?>
		<?php echo $form->error($model,'dep_status'); ?>
	</div>
 <div class="row">
        <?php echo $form->labelEx($model,'work_time'); ?>
        <?php echo $form->textField($model,'work_time',array('size' => 45, 'maxlength' => 200)); ?>
        <?php echo $form->error($model,'work_time'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->