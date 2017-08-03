<?php
class userViewAdmin extends CWidget {
 
    public $question=array(),$user_id;
 
    public function run() {
        $this->render('userViewAdmin');
    }
 
}
?>