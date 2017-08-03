<?php
/* @var $this UsersController */
/* @var $model Users */
$userid = Yii::app()->user->getId();

$fav = Yii::app()->db->createCommand("SELECT questions.* FROM questions INNER JOIN favorite ON questions.QuestionsId=favorite.QuestionId WHERE favorite.userid=$userid AND questions.subId=$model->SubjectId;")->queryAll();
$cc = count($fav);

for ($i=0; $i < $cc; $i++) { 
	$qid = $fav[$i]['QuestionsId'];
	$this->widget('application.components.questionsAll', array(
		'question' => $fav[$i],
		'user_id' => $userid,
		'QID' => $qid,
		'seemore'=>true,
		'questionUserName'=>$this->getName($qid),
		));
}
?>
