<?php
/* @var $this QuestionsController */
/* @var $model Questions */

$this->breadcrumbs=array(
	'Questions'=>array('index'),
	$model->QuestionsId=>array('view','id'=>$model->QuestionsId),
	'Update',
);

$this->menu=array(
	array('label'=>'List Questions', 'url'=>array('index')),
	array('label'=>'Create Questions', 'url'=>array('create')),
	array('label'=>'View Questions', 'url'=>array('view', 'id'=>$model->QuestionsId)),
	array('label'=>'Manage Questions', 'url'=>array('admin')),
);
?>

<h1>Update Questions <?php echo $model->QuestionsId; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>