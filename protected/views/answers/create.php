<?php
/* @var $this AnswersController */
/* @var $model Answers */

$this->breadcrumbs=array(
	'Answers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Answers', 'url'=>array('index')),
	array('label'=>'Manage Answers', 'url'=>array('admin')),
);
?>

<h1>Create Answers</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>