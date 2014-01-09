<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'depcompetitor-form',
	'enableAjaxValidation'=>false,
)); ?>

	
	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'dep_id'); ?>
        <?php echo $form->dropDownList($model,'dep_id',CHtml::listData(Department::model()->findAll(), 'dep_id', 'dep_name')); ?>
        <?php echo $form->error($model,'dep_id'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'competitor_id'); ?>
        <?php echo $form->dropDownList($model,'competitor_id',CHtml::listData(Competitor::model()->findAll(), 'competitor_id', 'category')); ?>
        <?php echo $form->error($model,'competitor_id'); ?>
    </div>

<div class="row">
        <?php echo $form->labelEx($model,'current_quantity'); ?>
        <?php echo $form->textField($model,'current_quantity',array('size' => 45, 'maxlength' => 200)); ?>
        <?php echo $form->error($model,'current_quantity'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'status'); ?>
        <?php echo $form->dropDownList($model,'status',POSM::model()->getStatusOptions()); ?>
        <?php echo $form->error($model,'status'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'state'); ?>
        <?php echo $form->dropDownList($model,'state',POSM::model()->getStateOptions()); ?>
        <?php echo $form->error($model,'state'); ?>
    </div>
<div class="row">
        <?php echo $form->labelEx($model,'note'); ?>
        <?php echo $form->textField($model,'note',array('size' => 45, 'maxlength' => 200)); ?>
        <?php echo $form->error($model,'note'); ?>
    </div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->