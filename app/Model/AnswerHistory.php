<?php
App::uses('AppModel', 'Model');
class AnswerHistory extends AppModel {

    public $name = "AnswerHistory";
    public $post_params = array();
    public $parameters = array("kentei_id", "problem_id", "user_id", "answer_flag", "answer_text");

    public function parameterCheck($key, $request_params){
        if(array_key_exists($key, $request_params)){
            $this->post_params[$key] = $request_params[$key];
        }elseif($key != "answer_text"){
            throw new NotFoundException("未入力の項目があるか、入力内容が間違っています。",400);
        }
    }

    public function makeParameter($request_params){
        foreach($this->parameters as $parameter){
            $this->parameterCheck($parameter, $request_params);
        }
        return $this->post_params;
    }

}
