<?php
// App::uses('AppModel', 'Model');
class Level extends AppModel {
    public $name = "Level";

    public $parameters = array("id", "user_id", "use_level", "know_level", "use_point", "login_point", "answer_point", "make_point", "evaluate_point");

    public $result = array();

    public function Parameter($response){

        foreach($this->parameters as $parameter){
        	$this->result[$parameter] = "deta";
        }

        return $this->result;
    }


}