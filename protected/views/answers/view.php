<?php
/* @var $this AnswersController */
/* @var $model Answers */

$this->breadcrumbs=array(
	'Answers'=>array('index'),
	$model->Answerid,
);

$this->menu=array(
	array('label'=>'List Answers', 'url'=>array('index')),
	array('label'=>'Create Answers', 'url'=>array('create')),
	array('label'=>'Update Answers', 'url'=>array('update', 'id'=>$model->Answerid)),
	array('label'=>'Delete Answers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Answerid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Answers', 'url'=>array('admin')),
);
?>

<h1>View Answers #<?php echo $model->Answerid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Answerid',
		'QuestionId',
		'studentId',
		'Text',
		'Date',
		'approved',
	),
)); ?>
