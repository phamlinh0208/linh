<?php 
echo '<h1>Thông tin bác sĩ</h1>';
?>
<div style="float:left;width:100%;">
<div style="float:left;width:35%">
<?php
	echo CHtml::image(Yii::app()->request->baseUrl."/images/doctor/".$viewdetail["bs_img"], "", array("width"=>240));
?>
</div>
<div style="float:left;width:50%;margin-top:0px">
<div style="margin-top:0px;">
<?php
		echo "<span style='width:200px;display:inline-block;'>".Yii::t('department','doctor_name').'</span><span>: '.$viewdetail['bs_name']."</span>";
?>
</div>
<div style="margin-top:10px;">
<?php
echo "<span style='width:200px;display:inline-block;'>".Yii::t('department','doctor_email').'</span><span>: '.$viewdetail['bs_email']."</span>";
?>
</div>
<div style="margin-top:10px;">
<?php
echo "<span style='width:200px;display:inline-block;'>".Yii::t('department','doctor_phone').'</span><span>: '.$viewdetail['bs_phone']."</span>";
?>
</div>
<div style="margin-top:10px;">
<?php
echo "<span style='width:200px;display:inline-block;'>".Yii::t('department','doctor_office').'</span><span>: '.$viewdetail['bs_office']."</span>";
?>
</div>
<div style="margin-top:10px;">
<?php
echo "<span style='width:200px;display:inline-block;'>".Yii::t('department','doctor_event').'</span><span>: '.$viewdetail['bs_event']."</span>";
?>
</div>
<div style="margin-top:10px;">
<?php
echo "<span style='width:200px;display:inline-block;'>".Yii::t('department','doctor_member').'</span><span>: '.Staff::model()->getMemberTypeName($viewdetail['bs_member']==null?0:$viewdetail['bs_member'])."</span>";
?>
</div>
<div style="margin-top:10px;">
<?php
echo "<span style='width:200px;display:inline-block;'>".Yii::t('department','doctor_dep').'</span><span>: '.$viewdetail['dep_name']."</span>";
?>
</div>
<div style="margin-top:10px;">
<?php
//echo "<span style='width:200px;display:inline-block;'>".Yii::t('department','last_visit').'</span><span>: '.$viewdetail['last_visit']."</span>";
?>
</div>
</div>
</div>
<div style="float:left;width:100%;margin-top:20px">
<?php 
echo '<h1 >Thông tin phòng khám</h1>';
?>
<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(
            'label' => 'Mã phòng',
            'value' => $model['dep_code'],
        ),
		array(
            'label' => Yii::t('department','dep_name'),
            'value' => $model['dep_name'],
        ),
		array(
            'label' => Yii::t('department','dep_address'),
            'value' => $model['dep_address'],
        ),
		array(
            'label' => Yii::t('department','precinct'),
            'value' => $model['precinct'],
        ),
		array(
            'label' => Yii::t('department','district'),
            'value' => $model['district'],
        ),
		array(
            'label' => Yii::t('department','province'),
            'value' => $model['province'],
        ),
		
        array(
            'label' => Yii::t('department','number_chair'),
            'value' => Department::model()->getChair($model['number_chair']?$model['number_chair']:-1),
        ),
        array(
            'label' => Yii::t('department','dien_tich'),
            'value' => Department::model()->getDienTich($model['dien_tich']?$model['dien_tich']:-1),
        ),

        array(
            'label' => Yii::t('department','phong_khach'),
            'value' => Department::model()->getYesNoName($model['phong_khach']?$model['phong_khach']:0),
        ),

		array(
            'label' => Yii::t('department','lt_name'),
            'value' => $model['lt_name'],
        ),
		array(
            'label' => Yii::t('department','lt_phone'),
            'value' => $model['lt_phone'],
        ),
		array(
            'label' => Yii::t('department','dep_phone'),
            'value' => $model['dep_phone'],
        ),
		array(
            'label' => Yii::t('department','dep_mail'),
            'value' => $model['dep_mail'],
        ),
		array(
            'label' => Yii::t('department','count_ns'),
            'value' =>$model['count_ns'],
        ),
		array(
            'label' => Yii::t('department','count_pt'),
            'value' => $model['count_pt'],
        ),
		array(
            'label' => Yii::t('department','description'),
            'value' => $model['description'],
        ),
		array(
            'label' => Yii::t('department','last_visit'),
            'value' => $viewdetail['last_visit'],
        ),
	),
)); ?>
<div style="float:left;width:100%;margin-top:20px;">
<?php
echo "<b>".Yii::t('department','img_dep')."</b>";
echo "<br/>";
echo "<br/>";
foreach ($images as $image)
{
	echo CHtml::image(Yii::app()->request->baseUrl."/images/department/".$image["img_url"], "", array("height"=>150,"width"=>150,"style"=>"margin-right:10px;"));
}

?>
<?php
$this->widget('zii.widgets.CMenu', array(
    'firstItemCssClass'=>'first',
    'lastItemCssClass'=>'last',
    'htmlOptions'=>array('class'=>'actions',"style"=>"display:block;margin-top:20px;"),
    'items'=>array(

        array(
            'label'=>Yii::t('department', 'create_img'),
            'url'=>array('/Image/create&dep_id='.$model['dep_id']),
        ),

    )
));
?>
</div>
</div>
<?php
/*
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'img-grid',
    'dataProvider' => $image,

    'columns' => array(

        array(
            'name' => Yii::t('department','image'),
            'type' => 'html',
            'value' => 'CHtml::image(Yii::app()->request->baseUrl."/images/department/".$data["img_url"], "", array("width"=>240))',
        ),

        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{delete}',
            'buttons' => array(
                'header' => '',


                'delete' => array(
                    'label' => 'Delete', // text label of the button
                    'url' => 'Yii::app()->createUrl("Image/delete",array("id"=>$data["id"]))',
                    'imageUrl' => Yii::app()->baseUrl . '/images/system/delete.png', // image URL of the button. If not set or false, a text link is used
                    'options' => array('class' => 'copy'), // HTML options for the button
                ),
            ),
        ),

    ),
));
*/
?>


