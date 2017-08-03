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

	<div class="row">
 <?php
 $type = Yii::app()->user->getState('TYPE');
 $depid = Yii::app()->user->getState('DepId');
 ?>
            <?php echo $form->labelEx($model,'Year :'); ?>
            <select name='Users[year]'>
                <?php if($type=='student') {?>
                <option value='0'>e3dady</option>
                <option value='1'>ola</option>
                <option value='2'>tanya</option>
                <option value='3'>talta</option>
                <option value='4'>rab3a</option>
                <?php }else{ 
                   
		$rowCount  = Yii::app()->db->createCommand("SELECT * FROM subject WHERE DepId='$depid';")->queryAll(); 
		for($i=0;$i<count($rowCount);$i++)
                {
                    $subid=$rowCount[$i]['SubjectId'];
                    $name=$rowCount[$i]['Name'];
                    print "<option value='$subid'>$name</option>";
                }
                    
                    
                    ?>
                
                <?php } ?>
             </select>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'register' : 'update'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->