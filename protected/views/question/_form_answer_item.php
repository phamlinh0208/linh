
<tr>   

	<td>
        <?php echo $form->textField($model,"[$id]ans_text");?>
        <?php echo $form->error($model,"[$id]ans_text");?>
    </td>


    <td>
        <?php  echo $form->dropDownList($model, "[$id]ans_status", answer::model()->getStatusOptions()); ?>
        <?php echo $form->error($model,"[$id]ans_status");?>
    </td>
 
    <td>
        <?php echo CHtml::image(
                Yii::app()->request->baseUrl."/images/system/minus.png", 
                '', 
                array(
                    'class'=>'delete',
                    'onClick'=>'deleteSupplierFood($(this))',
                    ));?>
    </td>
    <td>
        <?php  echo $form->dropDownList($model, "[$id]ans_yn", answer::model()->getYesNoOptions(), array('style' => 'display: none')); ?>
        <?php echo $form->error($model,"[$id]ans_yn");?>
    </td>
</tr>