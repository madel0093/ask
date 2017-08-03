<?php

class FollowerController extends Controller
{
	public function actionFollowunfollow(){

		$field_id = Yii::app()->request->getParam('field_id');
		$user_id = Yii::app()->user->getId();
		
		$command  = Yii::app()->db->createCommand("SELECT * FROM follower WHERE questionId=$field_id AND userid=$user_id;");
		$rowCount = $command->execute();
		
		if($rowCount==0){
			$command  = Yii::app()->db->createCommand("INSERT INTO follower (questionId , userid) values($field_id ,  $user_id);");
			$command->execute(); 
			$displaynow = 'Unfollow';
		}else{
			$command  = Yii::app()->db->createCommand("DELETE FROM follower WHERE questionId=$field_id AND userid=$user_id;");
			$command->execute(); 
			$displaynow = 'Follow';
		}
		$data['displaytext2'] = $displaynow;
		echo json_encode($data);
	}
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}