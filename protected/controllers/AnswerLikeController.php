<?php

class AnswerLikeController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rulesf.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view' , 'likedislike'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new AnswerLike;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AnswerLike']))
		{
			$model->attributes=$_POST['AnswerLike'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->answerLikeId));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AnswerLike']))
		{
			$model->attributes=$_POST['AnswerLike'];

			if($model->save())
				$this->redirect(array('view','id'=>$model->answerLikeId));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('AnswerLike');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new AnswerLike('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AnswerLike']))
			$model->attributes=$_GET['AnswerLike'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return AnswerLike the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=AnswerLike::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param AnswerLike $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='answer-like-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionLikedislike(){

		$field_id = Yii::app()->request->getParam('field_id');
		$user_id = Yii::app()->user->getId();
		
		$command  = Yii::app()->db->createCommand("SELECT * FROM answer_like WHERE answerId=$field_id AND userId=$user_id;");
		$rowCount = $command->execute();
		$rows	  = $command->queryAll();
		
		if($rowCount==0){
			$command  = Yii::app()->db->createCommand("INSERT INTO answer_like (answerId , userId , Rate) values($field_id ,  $user_id , '1');");
			$command->execute(); 
			$displaynow = 'Unlike';

			$cc = Yii::app()->db->createCommand("SELECT * FROM answer_like WHERE answerId=$field_id AND Rate='1'")->queryAll();
			$cc = count($cc);
			$userAns = Yii::app()->db->createCommand("SELECT * FROM answers WHERE Answerid=$field_id;")->queryAll();
			$userAnsq = $userAns[0]['QuestionId'];
			$userAns = $userAns[0]['userId'];
			$text = NULL;
			if($cc > 1)	$text = $cc." people like your answer";
			else 		$text = $cc." person like your answer";
			$isNotified = Yii::app()->db->createCommand("SELECT * FROM notification WHERE userid=$userAns AND questionId=$userAnsq AND type='$field_id like';")->execute(); 			
			if($isNotified > 0){
				Yii::app()->db->createCommand("UPDATE notification set seen=1,text='$text' WHERE userid=$userAns AND questionId=$userAnsq AND type='$field_id like';")->execute();
			}else{
				Yii::app()->db->createCommand("INSERT INTO notification (userid,text,seen,questionId,type) VALUES ('$userAns','$text','0',$userAnsq,'$field_id like')")->execute();
			}
		}
		else if($rows[0]['Rate'] == '0'){
			$command  = Yii::app()->db->createCommand("UPDATE answer_like SET Rate='1' WHERE answerId=$field_id AND userId=$user_id;");
			$command->execute(); 
			$displaynow = 'Unlike';
		}
		else{
			$command  = Yii::app()->db->createCommand("UPDATE answer_like SET Rate='0' WHERE answerId=$field_id AND userId=$user_id;");
			$command->execute(); 
			$displaynow = 'Like';
		}
		$data['displaytext'] = $displaynow;
		$data['count'] = Yii::app()->db->createCommand("SELECT COUNT(*) FROM answer_like WHERE answerId=$field_id AND Rate='1'")->queryColumn();
		echo json_encode($data);
	}
}
