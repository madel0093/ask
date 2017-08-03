<?php
 $user_id=$this->user_id;
 $users = Yii::app()->db->createCommand("SELECT * FROM users WHERE userid = $user_id;")->queryAll();
?>
<script type="text/javascript">
    function approvejsq(field_id ){
        var base_url = "<?php echo Yii::app()->baseUrl;?>/index.php/users/ApproveDisapprove";
        $.post( base_url, {field_id:field_id} ,
        function(data) {
            $("#displaytext2_"+field_id).html(data.displaytext);
        },'json');
    }</script>
  <article>
<section>

<h1 align="left"><?php echo CHtml::encode($users[0]['Fname'].' '.$users[0]['Lname']); ?></h1>

</section>

<span><a class="button add" href="javascript:void(0);" onclick="approvejsq('<?php echo $user_id;?>')" >
    <span id="displaytext2_<?php echo $user_id;?>">
        <?php 
            if($users[0]['activated'] == 0)   {echo 'Approve';}
            else                 {echo 'dis-Approve';} ?></span></a></span>&nbsp


            
        </article>