<?php
/* @var $this QuestionLikeController */
/* @var $model QuestionLike */

$this->breadcrumbs=array(
	'Question Likes'=>array('index'),
	$model->questionLikeId=>array('view','id'=>$model->questionLikeId),
	'Update',
);

$this->menu=array(
	array('label'=>'List QuestionLike', 'url'=>array('index')),
	array('label'=>'Create QuestionLike', 'url'=>array('create')),
	array('label'=>'View QuestionLike', 'url'=>array('view', 'id'=>$model->questionLikeId)),
	array('label'=>'Manage QuestionLike', 'url'=>array('admin')),
);
?>

<h1>Update QuestionLike <?php echo $model->questionLikeId; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>