<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$count=Yii::app()->db->createCommand("SELECT COUNT(Answerid) FROM answers where QuestionId='$QuestionsId'")->queryScalar();
$sql="SELECT * FROM answers where QuestionId='$QuestionsId' ORDER BY approved DESC";
$dataProvider=new CSqlDataProvider($sql,array(
        'keyField' => 'Answerid',
        'totalItemCount'=>$count,
        'pagination'=>array(
        'pageSize'=>10,
    )));


$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'/answers/_view',
));
?>
