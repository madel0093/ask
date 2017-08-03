<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $userid
 * @property string $Email
 * @property string $Password
 * @property string $Fname
 * @property string $Lname
 * @property integer $DepId
 * @property string $type
 * @property string $activated
 *
 * The followings are the available model relations:
 * @property AnswerLike[] $answerLikes
 * @property Answers[] $answers
 * @property Subject[] $subjects
 * @property Questions[] $questions
 * @property Notification[] $notifications
 * @property Questions[] $questions1
 * @property Questions[] $questions2
 * @property Studs $studs
 * @property Departments $dep
 */
class Users extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
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
			array('Email, Password, Fname, Lname, type, activated', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('userid, Email, Password, Fname, Lname, DepId, type, activated', 'safe', 'on'=>'search'),
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
			'answerLikes' => array(self::HAS_MANY, 'AnswerLike', 'userId'),
			'answers' => array(self::HAS_MANY, 'Answers', 'userId'),
			'subjects' => array(self::MANY_MANY, 'Subject', 'doctors(userId, SubId)'),
			'questions' => array(self::MANY_MANY, 'Questions', 'follower(userid, questionId)'),
			'notifications' => array(self::HAS_MANY, 'Notification', 'userid'),
			'questions1' => array(self::MANY_MANY, 'Questions', 'question_like(userId, questionId)'),
			'questions2' => array(self::HAS_MANY, 'Questions', 'userId'),
			'studs' => array(self::HAS_ONE, 'Studs', 'userId'),
			'dep' => array(self::BELONGS_TO, 'Departments', 'DepId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userid' => 'Userid',
			'Email' => 'Email',
			'Password' => 'Password',
			'Fname' => 'Fname',
			'Lname' => 'Lname',
			'DepId' => 'Dep',
			'type' => 'Type',
			'activated' => 'Activated',
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

		$criteria->compare('userid',$this->userid);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('Password',$this->Password,true);
		$criteria->compare('Fname',$this->Fname,true);
		$criteria->compare('Lname',$this->Lname,true);
		$criteria->compare('DepId',$this->DepId);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('activated',$this->activated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
