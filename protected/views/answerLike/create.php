<?php
/* @var $this AnswerLikeController */
/* @var $model AnswerLike */

$this->breadcrumbs=array(
	'Answer Likes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AnswerLike', 'url'=>array('index')),
	array('label'=>'Manage AnswerLike', 'url'=>array('admin')),
);
?>

<h1>Create AnswerLike</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>