<?php
/* @var $this AnswersController */
/* @var $model Answers */
/* @var $form CActiveForm */
?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'answers-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
        'htmlOptions'=>array(
                               'onsubmit'=>"return false;",/* Disable normal form submit */
                               'onkeypress'=>" if(event.keyCode == 13){ send(); } " /* Do ajax call when user presses enter key */
                             ),
)); ?>


	<?php echo $form->errorSummary($model); ?>

	<!-- <div class="row">
		<?php echo $form->labelEx($model,'QuestionId'); ?>
		<?php echo $form->textField($model,'QuestionId'); ?>
		<?php echo $form->error($model,'QuestionId'); ?>
	</div> -->

        <div id="hongkiat-form" >	
<div id="wrapping" class="clearfix">  
    <section id="aligned">  
        <textarea name="Answers[Text]" id="message" placeholder="Answer the Question" tabindex="5" class="txtblock"></textarea>  
    </section> 
    </div>
            </div>
	<div class="row">
		<?php echo $form->error($model,'Text'); ?>
	</div>

<!-- 	<div class="row">
		<?php echo $form->labelEx($model,'Date'); ?>
		<?php echo $form->textField($model,'Date',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'approved'); ?>
		<?php echo $form->textField($model,'approved',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'approved'); ?>
	</div> -->
<section id="buttons" align=right">  
    <input onclick="send();" class="submitbtn"  name="yt0" type="button" value="answer" id="submitbtn" />
</section><br><br>
<script type="text/javascript">
 
function send()
 {
 
   var data=$("#answers-form").serialize();
 
  $.ajax({
   type: 'POST',
    url: '<?php echo Yii::app()->createAbsoluteUrl("answers/create?qid=".$model->QuestionId); ?>',
   data:data,
success:function(data){
    $( "#answersdata" ).load( "<?php echo Yii::app()->createAbsoluteUrl("questions/UpdateAnswers?id=".$model->QuestionId); ?>" );
              },
   error: function(data) { // if error occured
         alert("Error occured.please try again");
    },
 
  dataType:'html'
  });
 
}
 
</script>
<?php $this->endWidget(); ?>

</div><!-- form -->