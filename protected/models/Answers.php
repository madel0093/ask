<?php

/**
 * This is the model class for table "answers".
 *
 * The followings are the available columns in table 'answers':
 * @property integer $Answerid
 * @property integer $QuestionId
 * @property integer $userId
 * @property string $Text
 * @property string $Date
 * @property string $approved
 *
 * The followings are the available model relations:
 * @property Questions $question
 * @property Users $user
 */
class Answers extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'answers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('QuestionId, userId', 'required'),
			array('QuestionId, userId', 'numerical', 'integerOnly'=>true),
			array('Date, approved', 'length', 'max'=>45),
			array('Text', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('Answerid, QuestionId, userId, Text, Date, approved', 'safe', 'on'=>'search'),
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
			'question' => array(self::BELONGS_TO, 'Questions', 'QuestionId'),
			'user' => array(self::BELONGS_TO, 'Users', 'userId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Answerid' => 'Answerid',
			'QuestionId' => 'Question',
			'userId' => 'User',
			'Text' => 'Text',
			'Date' => 'Date',
			'approved' => 'Approved',
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

		$criteria->compare('Answerid',$this->Answerid);
		$criteria->compare('QuestionId',$this->QuestionId);
		$criteria->compare('userId',$this->userId);
		$criteria->compare('Text',$this->Text,true);
		$criteria->compare('Date',$this->Date,true);
		$criteria->compare('approved',$this->approved,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Answers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
