<?php
class questionsAll extends CWidget {
 
    public $question=array(),$user_id,$QID,$questionUserName,$seemore;
 
    public function run() {
        $this->render('questionsAll');
    }
 
}
?>