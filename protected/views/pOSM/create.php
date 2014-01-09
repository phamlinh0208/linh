<?php

$this->menu=array(
	array('label'=>'List POSM', 'url'=>array('index')),
	array('label'=>'Manage POSM', 'url'=>array('admin')),
);
?>

<h1>Create POSM</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>