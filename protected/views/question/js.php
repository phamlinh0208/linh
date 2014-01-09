
<script type="text/javascript">
// initializiation of counters for new elements
var lastStudent=<?php echo $answerManager->lastNew?>;
 
// the subviews rendered with placeholders
var trStudent1=new String(<?php echo CJSON::encode($this->renderPartial('_form_answer_item', array('id'=>'idRep', 'model'=>new Answer(), 'form'=>$form), true));?>);
 
 
function addSupplierFood1(button)
{
    lastStudent++;
    button.parents('table').children('tbody').append(trStudent1.replace(/idRep/g,'n'+lastStudent));
}
function addSupplierFood2(button){
	lastStudent++;
    button.parents('table').children('tbody').append(trStudent2.replace(/idRep/g,'n'+lastStudent));
}
 
function deleteSupplierFood(button)
{
    button.parents('tr').detach();
}
 
</script>