<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'First name :'); ?>
		<?php echo $form->textField($model,'Fname',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Fname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Last name :'); ?>
		<?php echo $form->textField($model,'Lname',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Lname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Email'); ?>
		<?php echo $form->textField($model,'Email',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Password'); ?>
		<?php echo $form->passwordField($model,'Password',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Password'); ?>
	</div>
	<div class="row">
            <?php echo $form->labelEx($model,'Department :'); ?>
             <select name='Users[DepId]'>
                 
                 <?php
                    $departments = Yii::app()->db->createCommand("SELECT * FROM departments")->queryAll();
                    for($i=0;$i<count($departments);$i++)
                    {
                        $depid=$departments[$i]['DepartmentId'];
                        $Name=$departments[$i]['Name'];
                        print "<option value='$depid'>$Name</option>";
                    }
                 ?>
             </select>
	</div>

	<div class="row">
            <?php echo $form->labelEx($model,'Type :'); ?>
            <select name='Users[type]'>
                <option value='student'>student</option>
                <option value='doctor'>doctor</option>
             </select>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'register' : 'update'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->