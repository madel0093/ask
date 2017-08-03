<?php
/* @var $this AnswerLikeController */
/* @var $model AnswerLike */

$this->breadcrumbs=array(
	'Answer Likes'=>array('index'),
	$model->answerLikeId,
);

$this->menu=array(
	array('label'=>'List AnswerLike', 'url'=>array('index')),
	array('label'=>'Create AnswerLike', 'url'=>array('create')),
	array('label'=>'Update AnswerLike', 'url'=>array('update', 'id'=>$model->answerLikeId)),
	array('label'=>'Delete AnswerLike', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->answerLikeId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AnswerLike', 'url'=>array('admin')),
);
?>

<h1>View AnswerLike #<?php echo $model->answerLikeId; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'answerLikeId',
		'studentId',
		'Rate',
	),
)); ?>
