<?php

$this->menu=array(
	array('label'=>'List DepPosm', 'url'=>array('index')),
	array('label'=>'Manage DepPosm', 'url'=>array('admin')),
);
?>

<h1>Create DepPosm</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>