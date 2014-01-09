<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'dep-posm-form',
	'enableAjaxValidation'=>false,
)); ?>

	

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'dep_id'); ?>
        <?php echo $form->dropDownList($model,'dep_id',CHtml::listData(Department::model()->findAll(), 'dep_id', 'dep_name')); ?>
        <?php echo $form->error($model,'dep_id'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'posm_id'); ?>
        <?php echo $form->dropDownList($model,'posm_id',CHtml::listData(POSM::model()->findAll(), 'posm_id', 'category')); ?>
        <?php echo $form->error($model,'posm_id'); ?>
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
        <?php echo $form->labelEx($model, 'create_date'); ?>
        <?php  $this->widget('zii.widgets.jui.CJuiDatePicker',
        array(
            'attribute' => 'create_date', // Model attribute filed which hold user input
            'model' => $model, // Model name
            'options' => array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd'
            ),
            'htmlOptions' => array('size' => 15),
        )
    );?>
        <?php echo $form->error($model, 'create_date'); ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->