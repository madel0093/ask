<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->userid,
);?>
<article>
    <section>
<h1>Noifications</h1><br>

<?php
	$noties = Yii::app()->db->createCommand("SELECT * FROM notification WHERE userid=$model->userid;")->queryAll();
	Yii::app()->db->createCommand("UPDATE notification set seen=1 WHERE userid=$model->userid;")->execute();
	$notiesSize = count($noties);
	for ($i=0; $i < $notiesSize; $i++) { 
		echo "<h3>";		
		echo CHtml::link(CHtml::encode($noties[$i]['text']), array('questions/view', 'id'=>$noties[$i]['questionId']));
		echo "</h3>";		
	}
?>
<footer>Askeko <span id="arrow">Notifications</span></footer>
    </section>
</article>