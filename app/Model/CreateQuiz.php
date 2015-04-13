<?php
// App::uses('AppModel', 'Model');
class CreateQuiz extends AppModel {
    public $name = "CreateQuiz";

    public $result = array();

    public $parameters_one = array("kentei_id", "user_id", "sentence", "right_answer", "description", "category_id", "subcategory_id", "type");

    public $parameters_multi = array("kentei_id", "user_id", "sentence", "right_answer", "wrong_answer1", "wrong_answer2", "wrong_answer3", "description", "category_id", "subcategory_id", "type");


    public function Parameter($response){

    	if($response["type"] == 2) {
            foreach($this->parameters_one as $parameter_one){
                $this->result[$parameter_one] = "deta";
            }
    	}else if($response["type"] == 1){
            foreach($this->parameters_multi as $parameter_multi){
                $this->result[$parameter_multi] = "deta";
            }
        }

        // foreach($response as $registration){
        //         $this->result[] = $registration;
        // }

        return $this->result;
    }

}