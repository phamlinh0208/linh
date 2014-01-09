<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'image-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'img_url'); ?>
        <?php echo $form->fileField($model, 'img_url', array('size' => 45)); ?>
        <?php echo $form->error($model, 'img_url'); ?>
    </div>
    <?php if ($dep_id) { ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'dep_id'); ?>
        <?php echo $form->dropDownList($model, 'dep_id', CHtml::listData(Department::model()->findAll(array('condition' => 'dep_status=1 and dep_id=' .( $dep_id ? $dep_id : -1))), 'dep_id', 'dep_name'), array('disabled' => 'disabled')); ?>
        <?php echo $form->error($model, 'dep_id'); ?>
    </div>
    <?php }?>
    <?php if ($doctor_id) { ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'doctor_id'); ?>
        <?php echo $form->dropDownList($model, 'doctor_id', CHtml::listData(Staff::model()->findAll(array('condition' => 'staff_id=' .( $doctor_id ? $doctor_id : -1))), 'staff_id', 'staff_name'), array('disabled' => 'disabled')); ?>
        <?php echo $form->error($model, 'doctor_id'); ?>
    </div>
    <?php }?>
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->