<?php
$this->menu=array(
	array('label'=>'List Product', 'url'=>array('index')),
	array('label'=>'Manage Product', 'url'=>array('admin')),
);
?>

<h1>Tạo sản phẩm</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>