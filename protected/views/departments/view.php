<?php
/* @var $this DepartmentsController */
/* @var $model Departments */

$this->breadcrumbs=array(
	'Departments'=>array('index'),
	$model->Name,
);

$this->pageTitle = $model->Name;
$userid=yii::app()->user->getId();
$current_user=  Users::model()->findByPk($userid);
if($current_user->type=='superadmin'){
    $this->menu=array(
            array('label'=>'List Departments', 'url'=>array('index')),
            array('label'=>'Create Departments', 'url'=>array('create')),
            array('label'=>'Update Departments', 'url'=>array('update', 'id'=>$model->DepartmentId)),
            array('label'=>'Delete Departments', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->DepartmentId),'confirm'=>'Are you sure you want to delete this item?')),
            array('label'=>'Manage Departments', 'url'=>array('admin')),
            array('label'=>'Create Subejct', 'url'=>array('subject/create', 'did'=>$model->DepartmentId)),
    );
}
?>
<article>
    <section>
        <br />
        <h1>Department Sujects</h1>
        <?php $this->widget('zii.widgets.CListView', array(
        	'dataProvider'=>$subjectDataProvider,
        	'itemView'=>'/subject/_view',
        )); ?>
    </section>
</article>