<?php
// App::uses('AppModel', 'Model');
class GetQuizChoice extends AppModel {
    public $name = "GetQuizChoice";

    public $parameters_problem = array("id", "kentei_id", "user_id", "type", "grade", "number", "sentence", "right_answer", "wrong_answer1", "wrong_answer2", "wrong_answer3", "description", "other_answer", "image", "latitude", "longitude", "reference", "spot_id", "public_flag", "category_id", "subcategory_id", "employ", "created", "modified");

    public $parameters_category = array("id", "kentei_id", "name", "created");

    public $result = array();

    public function oneParameter($response){
        foreach($this->parameters_problem as $parameter_problem){
            $this->result["Problem"][$parameter_problem] = "deta";
         }   

        foreach($this->parameters_category as $parameter_category){
            $this->result["Category"][$parameter_category] = "deta";
        }

        return $this->result;
    }


    public function fiveParameter($response){

		for ($i=0; $i<5; $i++) {
        	foreach($this->parameters_problem as $parameter_problem){
                $this->result[$i]["Problem"][$parameter_problem] = "deta";
             }   

            foreach($this->parameters_category as $parameter_category){
                $this->result[$i]["Category"][$parameter_category] = "deta";
            }
		}
        
        return $this->result;
    }

}