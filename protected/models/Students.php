<?php

/**
 * This is the model class for table "students".
 *
 * The followings are the available columns in table 'students':
 * @property integer $studentsId
 * @property string $Email
 * @property string $Password
 * @property string $Score
 * @property string $Fname
 * @property string $Lname
 * @property integer $DepId
 *
 * The followings are the available model relations:
 * @property AnswerLike[] $answerLikes
 * @property Answers[] $answers
 * @property Questions[] $questions
 * @property QuestionLike[] $questionLikes
 * @property Questions[] $questions1
 * @property StudentNotification[] $studentNotifications
 * @property Departments $dep
 */
class Students extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'students';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DepId', 'required'),
			array('DepId', 'numerical', 'integerOnly'=>true),
			array('Email, Password, Score, Fname, Lname', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('studentsId, Email, Password, Score, Fname, Lname, DepId', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'answerLikes' => array(self::HAS_MANY, 'AnswerLike', 'studentId'),
			'answers' => array(self::HAS_MANY, 'Answers', 'studentId'),
			'questions' => array(self::MANY_MANY, 'Questions', 'follower(StudentId, questionId)'),
			'questionLikes' => array(self::HAS_MANY, 'QuestionLike', 'studentId'),
			'questions1' => array(self::HAS_MANY, 'Questions', 'studentId'),
			'studentNotifications' => array(self::HAS_MANY, 'StudentNotification', 'studentId'),
			'dep' => array(self::BELONGS_TO, 'Departments', 'DepId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'studentsId' => 'Students',
			'Email' => 'Email',
			'Password' => 'Password',
			'Score' => 'Score',
			'Fname' => 'Fname',
			'Lname' => 'Lname',
			'DepId' => 'Dep',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('studentsId',$this->studentsId);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('Password',$this->Password,true);
		$criteria->compare('Score',$this->Score,true);
		$criteria->compare('Fname',$this->Fname,true);
		$criteria->compare('Lname',$this->Lname,true);
		$criteria->compare('DepId',$this->DepId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Students the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
