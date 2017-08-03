<?php

class AnswersController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	private $_question = null; 
	/**
	* Protected method to load the associated Project model class
	* @param integer projectId the primary identifier of the associated Project
	* @return object the Project data model based on the primary key 
	*/
	
/* @var $this AnswersController */
/* @var $data Answers */

	protected function loadQuestion($questionId) {
	//if the project property is null, create it based on input id
		if($this->_question===null)
		{
                        $cc = Yii::app()->db->createCommand("SELECT * FROM questions WHERE QuestionsId=$questionId")->queryAll();
                        $questionback= new Questions;
                        $questionback->attributes=$cc[0];
			if($this->_question===null)
			{
				throw new CHttpException(404,'The requested Question does not exist.'); 
			}
		}
		return $this->_question; 
	} 
	/**
	* In-class defined filter method, configured for use in the above filters() 
	* method. It is called before the actionCreate() action method is run in 
	* order to ensure a proper project context
	*/
	public function filterQuestionContext($filterChain)
	{ 
	//set the project identifier based on GET input request variables 
		if(isset($_GET['qid']))
			$this->loadQuestion($_GET['qid']); 
		else
			throw new CHttpException(403,'Must specify a Question before performing this action.');
	//complete the running of other filters and execute the requested action
		$filterChain->run();
	}


	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
			'questionContext + index admin create', //check to ensure valid project context
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
				'actions'=>array('index','view','create'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','approve','Unapprove','create'),
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
	public function pushNotification($userid,$questionId , $type)
	{
		$subjectId = Yii::app()->db->createCommand("SELECT subId FROM questions WHERE QuestionsId=$questionId;")->queryScalar();
        $doctors = Yii::app()->db->createCommand("SELECT * FROM doctors WHERE SubId=$subjectId")->queryAll();
        $student = Yii::app()->db->createCommand("SELECT * FROM users WHERE userid=$userid")->queryAll();
        $followers = Yii::app()->db->createCommand("SELECT * FROM follower WHERE questionId=$questionId;")->queryAll();

        $size=count($doctors);
        $fsize = count($followers);
        $studentsSize=count($student);
        // new answer for question kza
        if($studentsSize>0){
        	$text = NULL;
        	if($type == 'ans'){
        		$text = "New answer added for a question you are following";
        	}else{
        		$text = "New approved answer for a question you are following";
        	}
        	//..................
            for($i=0;$i<$size;$i++){
                $doctor=$doctors[$i];
                if($doctor['userId'] == $student[0]['userid']){
            		continue;
            	}
				$doctorUserID=$doctor['userId'];
            	$isNotified = Yii::app()->db->createCommand("SELECT * FROM notification WHERE questionId=$questionId AND type='$type' AND userid = $doctorUserID;")->execute();
                if($isNotified > 0){
					Yii::app()->db->createCommand("UPDATE notification set seen=1 WHERE questionId=$questionId AND type='$type' AND userid = $doctorUserID;")->execute();
                }else{
	                Yii::app()->db->createCommand("INSERT INTO notification (userid,text,seen,questionId,type) VALUES ('$doctorUserID','$text','0',$questionId,'$type')")->execute();
            	}
            }
            //-----------------
            for($i=0;$i<$fsize;$i++){
                $follower=$followers[$i];
                if($follower['userid'] == $student[0]['userid']){
            		continue;
            	}
                $followerUserID=$follower['userid'];
                $isNotified = Yii::app()->db->createCommand("SELECT * FROM notification WHERE questionId=$questionId AND type='$type' AND userid = $followerUserID;")->execute();
                if ($isNotified == 1){
                	Yii::app()->db->createCommand("UPDATE notification set seen=1 WHERE questionId=$questionId AND type='$type' AND userid = $followerUserID;")->execute();
                }else{
                	Yii::app()->db->createCommand("INSERT INTO notification (userid,text,seen,questionId) VALUES ('$followerUserID','$text','0',$questionId)")->execute();
                }
            }
            //----------------
        }
    }
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Answers;
		$model->QuestionId = $this->_question->QuestionsId;
		$model->userId = Yii::app()->user->getId();
        $userid=$model->userId;
        $user = Yii::app()->db->createCommand("SELECT * FROM users WHERE userid=$userid")->queryAll();
        $type = $user[0]['type'];
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Answers']))
		{
			$model->attributes=$_POST['Answers'];
            $questionId=$model->QuestionId;
            $userId=$model->userId;
            $Text=$model->Text;
            $date=getdate();
            $date=$date[0];
            $approved=0;
            if($type=='doctor') $approved=$userId;
            Yii::app()->db->createCommand("INSERT INTO answers (QuestionId,userId,Text,Date,approved) VALUES ('$questionId','$userId','$Text','$date','$approved');")->execute();
            $lasId = Yii::app()->db->lastInsertID;
            $isFollowing  = Yii::app()->db->createCommand("SELECT * FROM follower WHERE questionId=$questionId AND userid=$userId;")->execute();
            if($isFollowing == 0){
            	Yii::app()->db->createCommand("INSERT INTO follower (questionId , userid) values($questionId ,  $userId);")->execute();
            }
            $this->pushNotification($model->userId , $model->QuestionId , 'ans');
            //$this->redirect(array('view','id'=>$las));
            $this->redirect(array('questions/view','id'=>$model->QuestionId));

			/*if($model->save())
				$this->redirect(array('view','id'=>$model->Answerid));*/
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
        public function  actionUnapprove($answerId)
        {
            if(Yii::app()->user->getId() != null){
                $userid = Yii::app()->user->getId();
                $doctor = Yii::app()->db->createCommand("SELECT * FROM doctors WHERE userid=$userid")->queryAll();
                $answer = Yii::app()->db->createCommand("SELECT * FROM answers WHERE Answerid=$answerId")->queryAll();
                $questionId=$answer[0]['QuestionId'];
                $question = Yii::app()->db->createCommand("SELECT * FROM questions WHERE QuestionsId=$questionId")->queryAll();
                if(count($doctor)>0 && count($question)>0 && $doctor[0]['SubId']==$question[0]['subId'] && $answer[0]['approved']==$userid)
                {
                    Yii::app()->db->createCommand("UPDATE answers SET approved='0' WHERE Answerid=$answerId")->execute();
                }
            }
        }
        public function  actionApprove($answerId)
        {
            if(Yii::app()->user->getId() != null){
                $userid = Yii::app()->user->getId();
                $doctor = Yii::app()->db->createCommand("SELECT * FROM doctors WHERE userid=$userid")->queryAll();
                $answer = Yii::app()->db->createCommand("SELECT * FROM answers WHERE Answerid=$answerId")->queryAll();
                $questionId=$answer[0]['QuestionId'];
                $question = Yii::app()->db->createCommand("SELECT * FROM questions WHERE QuestionsId=$questionId")->queryAll();
                if(count($doctor)>0 && count($question)>0 && $doctor[0]['SubId']==$question[0]['subId'] && $answer[0]['approved']==0)
                {
                    Yii::app()->db->createCommand("UPDATE answers SET approved='$userid' WHERE Answerid=$answerId")->execute();
                }
                $this->pushNotification($userid , $questionId , 'app');
				$userAnsq = $answer[0]['QuestionId'];
				$userAns = $answer[0]['userId'];
				$text = "Your answer was approved";
				$isNotified = Yii::app()->db->createCommand("SELECT * FROM notification WHERE userid=$userAns AND questionId=$userAnsq AND type='$answerId app';")->execute(); 			
				if($isNotified > 0){
					Yii::app()->db->createCommand("UPDATE notification set seen=1 WHERE userid=$userAns AND questionId=$userAnsq AND type='$answerId app';")->execute();
				}else{
					Yii::app()->db->createCommand("INSERT INTO notification (userid,text,seen,questionId,type) VALUES ('$userAns','$text','0',$userAnsq,'$answerId app')")->execute();
				}
            }
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

		if(isset($_POST['Answers']))
		{
			$model->attributes=$_POST['Answers'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->Answerid));
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
		$dataProvider=new CActiveDataProvider('Answers');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Answers('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Answers']))
			$model->attributes=$_GET['Answers'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Answers the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Answers::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Answers $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='answers-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    static public function getName($id){
        $question = Yii::app()->db->createCommand("SELECT * FROM answers WHERE Answerid=$id")->queryAll();
        if(count($question)==0) return "";
        $userid=$question[0]['userId'];
        $user = Yii::app()->db->createCommand("SELECT * FROM users WHERE userid=$userid")->queryAll();
        if(count($user)==0) return "";
        return $user[0]['Fname'].' '.$user[0]['Lname'];
    }
}
