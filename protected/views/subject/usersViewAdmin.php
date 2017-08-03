<?php
/* @var $this UsersController */
/* @var $model Users */
$userid = Yii::app()->user->getId();
$deid=$model->DepId;
$year=$model->year;
$users = Yii::app()->db->createCommand("SELECT u.* FROM users as u,studs as s WHERE u.userid=s.userId AND u.DepId='$deid' AND s.year='$year'")->queryAll();
$cc = count($users);

for ($i=0; $i < $cc; $i++) { 
	$this->widget('application.components.userViewAdmin', array(
		'user_id' => $users[$i]['userid'],
		));
}
?>
