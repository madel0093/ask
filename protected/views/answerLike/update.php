<?php
/* @var $this AnswerLikeController */
/* @var $model AnswerLike */

$this->breadcrumbs=array(
	'Answer Likes'=>array('index'),
	$model->answerLikeId=>array('view','id'=>$model->answerLikeId),
	'Update',
);

$this->menu=array(
	array('label'=>'List AnswerLike', 'url'=>array('index')),
	array('label'=>'Create AnswerLike', 'url'=>array('create')),
	array('label'=>'View AnswerLike', 'url'=>array('view', 'id'=>$model->answerLikeId)),
	array('label'=>'Manage AnswerLike', 'url'=>array('admin')),
);
?>

<h1>Update AnswerLike <?php echo $model->answerLikeId; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>