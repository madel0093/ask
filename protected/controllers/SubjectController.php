<?php

class SubjectController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	* @var private property containing the associated Project model instance.
	*/
	private $_dept = null; 
	/**
	* Protected method to load the associated Project model class
	* @param integer projectId the primary identifier of the associated Project
	* @return object the Project data model based on the primary key 
	*/
	protected function loadDept($deptId) {
	//if the project property is null, create it based on input id
		if($this->_dept===null)
		{
			$this->_dept=Departments::model()->findByPk($deptId);
			if($this->_dept===null)
			{
				throw new CHttpException(404,'The requested Department does not exist.'); 
			}
		}
		return $this->_dept; 
	} 
	/**
	* In-class defined filter method, configured for use in the above filters() 
	* method. It is called before the actionCreate() action method is run in 
	* order to ensure a proper project context
	*/
	public function filterDeptContext($filterChain)
	{ 
	//set the project identifier based on GET input request variables 
		if(isset($_GET['did']))
			$this->loadDept($_GET['did']); 
		else
			throw new CHttpException(403,'Must specify a Department before performing this action.');
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
			'deptContext + index admin create', //check to ensure valid project context
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
				),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('favorites','Search','ViewUsersAdmin'),
				'users'=>array('@'),
				),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','create','update'),
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
	public function actionFavorites($id)
	{
		$this->render('favorites',array(
			'model'=>$this->loadModel($id),
		));
	}
	public function actionView($id)
	{
		$questionDataProvider=new CActiveDataProvider('Questions'
			, array(
				'criteria'=>array(
					'condition'=>'subId=:SubjectId',
					'params'=>array(':SubjectId'=>$this->loadModel($id)->SubjectId),
					),
				)
			);
                $subjectid=$id;
                $subjects=array();
                $subjects = Yii::app()->db->createCommand("SELECT * FROM questions WHERE subId=$subjectid")->queryAll();
		$this->render('view',array(
                        'subjectid'=>$subjectid,
                        'subjects'=>$subjects,
			'model'=>$this->loadModel($id),
			'questionDataProvider'=>$questionDataProvider,
			));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Subject;
		$model->DepId = $this->_dept->DepartmentId;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Subject']))
		{
			$model->attributes=$_POST['Subject'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->SubjectId));
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

		if(isset($_POST['Subject']))
		{
			$model->attributes=$_POST['Subject'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->SubjectId));
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
		$dataProvider=new CActiveDataProvider('Subject');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Subject('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Subject']))
			$model->attributes=$_GET['Subject'];

		$this->render('admin',array(
			'model'=>$model,
			));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Subject the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Subject::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Subject $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='subject-form')
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
        public function actionSearch($query){
                $subjectid=1;
                $subjects=array();
                $subjects = Yii::app()->db->createCommand("SELECT * FROM questions WHERE Text LIKE '%$query%' OR Description LIKE '%$query%'")->queryAll();
		$this->render('search',array('subjects'=>$subjects,));            
        }
        public function actionViewUsersAdmin($id){
            
 		$this->render('usersViewAdmin',array(
			'model'=>$this->loadModel($id),
		));           
        }
}
