<?php
App::uses('AppController', 'Controller');

class CreateQuizzesController extends AppController {
	public $name = "CreateQuizzes";
	public $uses = array('CreateQuiz');

	public $components = array('RequestHandler');

    public $result = array();




    public function createquiz(){
    	//一問一答
        if($this->params['url']['user_id'] != null && 
            $this->params['url']['sentence'] != null && 
            $this->params['url']['right_answer'] != null && 
            $this->params['url']['description'] != null && 
            $this->params['url']['category_id'] != null && 
            $this->params['url']['subcategory_id'] != null && 
            $this->params['url']['type'] != null){

            $response = $this->success(array("user_id" => $this->params['url']['user_id'], 
            									"sentence"  => $this->params['url']['sentence'], 
            									"right_answer" => $this->params['url']['right_answer'], 
            									"description" => $this->params['url']['description'], 
            									"category_id" => $this->params['url']['category_id'], 
            									"subcategory_id" => $this->params['url']['subcategory_id'], 
            									"type" => $this->params['url']['type']));


        }
        //選択形式
        else if($this->params['url']['user_id'] != null && 
            $this->params['url']['sentence'] != null && 
            $this->params['url']['right_answer'] != null && 
            $this->params['url']['wrong_answer1'] != null && 
            $this->params['url']['wrong_answer2'] != null && 
            $this->params['url']['wrong_answer3'] != null && 
            $this->params['url']['description'] != null && 
            $this->params['url']['category_id'] != null && 
            $this->params['url']['subcategory_id'] != null && 
            $this->params['url']['type'] != null){

            $response = $this->success(array("user_id" => $this->params['url']['user_id'], 
            									"sentence"  => $this->params['url']['employ'], 
            									"right_answer" => $this->params['url']['right_answer'], 
            									"wrong_answer1" => $this->params['url']['wrong_answer1'], 
            									"wrong_answer2" => $this->params['url']['wrong_answer2'], 
            									"wrong_answer3" => $this->params['url']['wrong_answer3'], 
            									"description" => $this->params['url']['description'], 
            									"category_id" => $this->params['url']['category_id'], 
            									"subcategory_id" => $this->params['url']['subcategory_id'], 
            									"type" => $this->params['url']['type']));


        }else{
            $response = array("code" => 401, "message" => "認証が失敗しているか、未認証の状態です。");
        }
        // debug($response);
        $this->set('response', $response);

    }

    public function success($response = array()){
        $result = array("code" => 200, "messae" => "リクエストに成功しました。");

        $result["Problem"] = $this->CreateQuiz->Parameter($response);
        // debug($result["Problem"]);
        return $result;

        // return $result['response'] = $response;

    }


}