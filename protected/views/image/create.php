<?php

?>

<h1>Create Image</h1>

<?php
if($dep_id){echo $this->renderPartial('_form', array('model'=>$model,'dep_id'=>$dep_id)); }
if($doctor_id){echo $this->renderPartial('_form', array('model'=>$model,'doctor_id'=>$doctor_id));}
?>