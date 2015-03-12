<?php
// App::uses('AppModel', 'Model');
class CreateQuiz extends AppModel {
    public $name = "CreateQuiz";

    public $result = array();



    public function Parameter($response){

    	if() {

    	}




        foreach($response as $registration){
                $this->result[] = $registration;
        }

        return $this->result;
    }


}