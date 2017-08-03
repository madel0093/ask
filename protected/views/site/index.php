<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php
if(Yii::app()->user->isGuest == true){ ?>
<article>
	<br><h3>Askeko is a question answer website  </h3>
	<br><h3>It targests educational systems questions like in schools and colleges</h3>
	<br><h3>It is 100% free register , so what are you waiting for JOIN us NOW </h3>
	<br><h3>We will be very happy to see you with us</h3>
	

		<footer>Askeko <span id="arrow">Home</span></footer>
</article>
<?php }else if(Yii::app()->user->getState('activated')==-1){
       $this->redirect(Yii::app()->createUrl('users/CompleteRegistration', array()));
?>
<?php }else{

	$userId = Yii::app()->user->getId();
	$dep = Yii::app()->db->createCommand("SELECT * FROM users WHERE  userid=$userId ;")->queryAll();
	$depid = $dep[0]['DepId'];
	$subs=array();
	if($dep[0]['type']=="student"){
		$year= Yii::app()->db->createCommand("SELECT * FROM studs WHERE userId = $userId;")->queryAll();
		$year = $year[0]['year'];
		$subs = Yii::app()->db->createCommand("SELECT questions.* FROM questions INNER JOIN subject ON questions.subId = subject.SubjectId WHERE DepId=$depid AND year='$year' ORDER BY  questions.QuestionsId DESC LIMIT 0 , 20;")->queryAll();
	}else if($dep[0]['type']=="doctor"){
		$subs = Yii::app()->db->createCommand("SELECT questions.* FROM questions INNER JOIN subject ON questions.subId = subject.SubjectId WHERE SubjectId in (SELECT SubId FROM doctors WHERE userId=$userId) ORDER BY  questions.QuestionsId DESC LIMIT 0 , 20;")->queryAll();
	}
	$c = count($subs);
	for ($i=0; $i < $c; $i++) { 
		$QID=$subs[$i]['QuestionsId'];
		$this->widget('application.components.questionsAll', array(
			'question' => $subs[$i],
			'user_id' => $userId,
			'QID' => $QID,
			'seemore'=>true,
			'questionUserName'=>$this->getName($QID),));
	}
}?>