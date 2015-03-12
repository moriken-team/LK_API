<?php
// App::uses('AppModel', 'Model');
class GetQuizChoice extends AppModel {
    public $name = "GetQuizChoice";

    public $parameters = array("problem_id", "employ", "grade", "number", "type", "category_name", "subcategory_name", "sentence", "right_answer", "wrong_answer1", "wrong_answer2", "wrong_answer3", "description");

    public $result = array();


    public function oneParameter($response){

        foreach($this->parameters as $parameter){
        	$this->result[$parameter] = "deta";
        }

        return $this->result;
    }


    public function fiveParameter($response){

        foreach($this->parameters as $parameter){
			for ($i=0; $i<5; $i++) {
	        	$this->result[$i][$parameter] = "deta";
			}
        }

        return $this->result;
    }

}