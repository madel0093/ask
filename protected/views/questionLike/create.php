<?php
/* @var $this QuestionLikeController */
/* @var $model QuestionLike */

$this->breadcrumbs=array(
	'Question Likes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List QuestionLike', 'url'=>array('index')),
	array('label'=>'Manage QuestionLike', 'url'=>array('admin')),
);
?>

<h1>Create QuestionLike</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>