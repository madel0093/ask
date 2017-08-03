<?php
/* @var $this AnswersController */
/* @var $model Answers */

$this->breadcrumbs=array(
	'Answers'=>array('index'),
	$model->Answerid=>array('view','id'=>$model->Answerid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Answers', 'url'=>array('index')),
	array('label'=>'Create Answers', 'url'=>array('create')),
	array('label'=>'View Answers', 'url'=>array('view', 'id'=>$model->Answerid)),
	array('label'=>'Manage Answers', 'url'=>array('admin')),
);
?>

<h1>Update Answers <?php echo $model->Answerid; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>