<?php

/**
 * This is the model class for table "questions".
 *
 * The followings are the available columns in table 'questions':
 * @property integer $QuestionsId
 * @property integer $userId
 * @property integer $subId
 * @property string $Text
 * @property string $date
 * @property string $Description
 *
 * The followings are the available model relations:
 * @property Answers[] $answers
 * @property Users[] $users
 * @property Users[] $users1
 * @property Users $user
 * @property Subject $sub
 */
class Questions extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'questions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId, subId', 'required'),
			array('userId, subId', 'numerical', 'integerOnly'=>true),
			array('date', 'length', 'max'=>45),
			array('Text, Description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('QuestionsId, userId, subId, Text, date, Description', 'safe', 'on'=>'search'),
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
			'answers' => array(self::HAS_MANY, 'Answers', 'QuestionId'),
			'users' => array(self::MANY_MANY, 'Users', 'favorite(QuestionId, userid)'),
			'users1' => array(self::MANY_MANY, 'Users', 'follower(questionId, userid)'),
			'user' => array(self::BELONGS_TO, 'Users', 'userId'),
			'sub' => array(self::BELONGS_TO, 'Subject', 'subId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'QuestionsId' => 'Questions',
			'userId' => 'User',
			'subId' => 'Sub',
			'Text' => 'Text',
			'date' => 'Date',
			'Description' => 'Description',
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

		$criteria->compare('QuestionsId',$this->QuestionsId);
		$criteria->compare('userId',$this->userId);
		$criteria->compare('subId',$this->subId);
		$criteria->compare('Text',$this->Text,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('Description',$this->Description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Questions the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
