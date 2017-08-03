<?php
/* @var $this QuestionLikeController */
/* @var $model QuestionLike */

$this->breadcrumbs=array(
	'Question Likes'=>array('index'),
	$model->questionLikeId,
);

$this->menu=array(
	array('label'=>'List QuestionLike', 'url'=>array('index')),
	array('label'=>'Create QuestionLike', 'url'=>array('create')),
	array('label'=>'Update QuestionLike', 'url'=>array('update', 'id'=>$model->questionLikeId)),
	array('label'=>'Delete QuestionLike', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->questionLikeId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage QuestionLike', 'url'=>array('admin')),
);
?>

<h1>View QuestionLike #<?php echo $model->questionLikeId; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'questionLikeId',
		'studentId',
		'rate',
	),
)); ?>
