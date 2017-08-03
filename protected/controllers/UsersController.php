<?php

class UsersController extends Controller
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
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','Register','ScoreCalculator','CompleteRegistration'),
				'users'=>array('*'),
				),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update' , 'notify' , 'favorite' , 'Favorites','ApproveDisapprove'),
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
            public function rules()//Email,Password,Fname,Lname,DepId,type
            {
                return array(

                    array('Email', 'required'),

                );
            }
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionFavorite()
	{
		$field_id = Yii::app()->request->getParam('field_id');
		$user_id = Yii::app()->user->getId();
		
		$rowCount  = Yii::app()->db->createCommand("SELECT * FROM favorite WHERE QuestionId=$field_id AND userid=$user_id;")->execute(); 
		
		if($rowCount==0){
			Yii::app()->db->createCommand("INSERT INTO favorite (QuestionId , userid) values($field_id ,  $user_id);")->execute(); 
			$displaynow = 'Remeove from Favorites';
		}else{
			Yii::app()->db->createCommand("DELETE FROM favorite WHERE QuestionId=$field_id AND userid=$user_id;")->execute(); ;
			$displaynow = 'Add to Favorites';
		}
		$data['displaytext3'] = $displaynow;
		echo json_encode($data);
	}
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			));
	}
	public function actionFavorites($id)
	{
		$sub = NULL;
		if(isset($_GET['sub'])){
			
			$sub = $_GET['sub'];
		}else
		throw new CHttpException(404,'The requested page does not exist.');
		$this->render('favorites',array(
			'model'=>$this->loadModel($id),
			'sub'=>$sub,
			));
	}
	public function actionNotify()
	{
		$id = Yii::app()->user->getId();
		$this->render('notify',array(
			'model'=>$this->loadModel($id),
			));
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionRegister()
	{
		if(yii::app()->user->getId()!=null){
			$this->redirect(Yii::app()->createUrl('site/index', array()));
		}
		$model=new Users;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
                        if(strlen($model->Email)>7 && $model->Password!=NULL && $model->Fname!=NULL && $model->Lname!=NULL && $model->DepId!=NULL && $model->type!=NULL)
                        {
                            Yii::app()->db->createCommand("INSERT INTO users (Email,Password,Fname,Lname,DepId,type,activated) VALUES ('$model->Email','$model->Password','$model->Fname','$model->Lname','$model->DepId','$model->type','-1');")->execute();
                            ///Yii::app()->db->createCommand("INSERT INTO users (Email,Password,Fname,Lname,DepId,type) VALUES ('$model->Email','$model->Password','$model->Fname','$model->Lname','$model->DepId','$model->type');")->execute(); 
                            $this->redirect(array('site/index',));
                        }
		}
		$this->render('create',array(
			'model'=>$model,
			));
	}///
	public function actionCompleteRegistration()
	{
            $userId = Yii::app()->user->getId();
            $type = Yii::app()->user->getState('TYPE');
		if($userId ==NULL || Yii::app()->user->getState('activated')!=-1){
                    $this->redirect(Yii::app()->createUrl('site/index', array()));
		}
		$model=new Users;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                
		if(isset($_POST['Users']))
		{
                    
			$data=$_POST['Users'];
                        $year=$data['year'];
                        if($type=='student')
                        {
                            
                            Yii::app()->db->createCommand("UPDATE users SET activated='0' WHERE userid=$userId")->execute();
                            Yii::app()->db->createCommand("INSERT INTO studs (userId,Score,year) VALUES ('$userId','0','$year');")->execute();
                            yii::app()->user->setState('activated','0');
                            $this->redirect(array('site/index',));
                        }else{
                            Yii::app()->db->createCommand("UPDATE users SET activated='0' WHERE userid=$userId")->execute();
                            Yii::app()->db->createCommand("INSERT INTO doctors (userId,SubId) VALUES ('$userId','$year');")->execute();
                            yii::app()->user->setState('activated','0');
                            $this->redirect(array('site/logout',));                           
                        }
		}
		$this->render('completeRegistration',array(
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

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->userid));
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
		$dataProvider=new CActiveDataProvider('Users');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Users('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];

		$this->render('admin',array(
			'model'=>$model,
			));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Users the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Users $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	static public function getName($id){
		$question = Yii::app()->db->createCommand("SELECT * FROM questions WHERE QuestionsId=$id")->queryAll();
		if(count($question)==0) return "";
		$userid=$question[0]['userId'];
		$user = Yii::app()->db->createCommand("SELECT * FROM users WHERE userid=$userid")->queryAll();
		if(count($user)==0) return "";
		return $user[0]['Fname'].' '.$user[0]['Lname'];
	}
	public function actionScoreCalculator(){
		$users = Yii::app()->db->createCommand("SELECT * FROM studs ;")->queryAll();
		for($i=0;$i<count($users);$i++)
		{
			$userid=$users[$i]['userid'];
			$studentAnswersLikeCounts = Yii::app()->db->createCommand("SELECT  count(*) FROM answer_like as al,answers as a WHERE a.userId=$userid AND al.answerId=a.Answerid AND a.approved='0'")->queryAll();
			$studentApprovedCounts = Yii::app()->db->createCommand("SELECT  count(*) FROM answer_like as al,answers as a WHERE a.userId=$userid AND al.answerId=a.Answerid AND a.approved>0")->queryAll();
			$studentQuestionLikeCounts = Yii::app()->db->createCommand("SELECT  count(*) FROM question_like as ql,questions as q WHERE q.userId=$userid AND ql.questionId=q.QuestionsId")->queryAll();
			$score=$studentAnswersLikeCounts[0]['count(*)']+$studentApprovedCounts[0]['count(*)']*10+$studentQuestionLikeCounts[0]['count(*)'];
			Yii::app()->db->createCommand("UPDATE studs SET Score='$score' WHERE userId='$userid'")->execute();
		}
	}
	public function actionApproveDisapprove(){
		$field_id = Yii::app()->request->getParam('field_id');
		
		$command  = Yii::app()->db->createCommand("SELECT * FROM users WHERE userid=$field_id");
		$rowCount = $command->execute();
		$rows	  = $command->queryAll();
		
                if($rowCount>0 && $rows[0]['activated']==1){
                    Yii::app()->db->createCommand("UPDATE users set activated=0 WHERE userid=$field_id")->execute();
                    $displaynow = 'approve';
                }else{
                     Yii::app()->db->createCommand("UPDATE users set activated=1 WHERE userid=$field_id")->execute();
                    $displaynow = 'dis-approve';                   
                }
		$data['displaytext'] = $displaynow;
		echo json_encode($data);
	}	
}
