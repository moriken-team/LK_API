<?php
App::uses('AppController', 'Controller');

class CreateQuizzesController extends AppController {
	public $name = "CreateQuizzes";
	public $uses = array('CreateQuiz');

	public $components = array('RequestHandler');

    public $result = array();




    public function createquiz(){
    	//一問一答
        if(isset($this->params['url']['kentei_id']) &&
            isset($this->params['url']['user_id']) && 
            isset($this->params['url']['sentence']) && 
            isset($this->params['url']['right_answer']) &&
            isset($this->params['url']['description']) && 
            isset($this->params['url']['category_id']) && 
            isset($this->params['url']['subcategory_id']) && 
            isset($this->params['url']['type'])){

            if($this->params['url']['kentei_id'] != null && 
                $this->params['url']['user_id'] != null && 
                $this->params['url']['sentence'] != null && 
                $this->params['url']['right_answer'] != null && 
                $this->params['url']['description'] != null && 
                $this->params['url']['category_id'] != null && 
                $this->params['url']['subcategory_id'] != null && 
                $this->params['url']['type'] != null){

                $response = $this->success(array("type" => $this->params['url']['type'],
                                                    "kentei_id" => $this->params['url']['kentei_id'], 
                                                    "user_id" => $this->params['url']['user_id'], 
                									"sentence"  => $this->params['url']['sentence'], 
                									"right_answer" => $this->params['url']['right_answer'], 
                									"description" => $this->params['url']['description'], 
                									"category_id" => $this->params['url']['category_id'], 
                									"subcategory_id" => $this->params['url']['subcategory_id']));


            }else{
                $response = array("code" => 401, "message" => "認証が失敗しているか、未認証の状態です。");
            }
        //選択形式
        }elseif(isset($this->params['url']['kentei_id']) && 
            isset($this->params['url']['user_id']) && 
            isset($this->params['url']['sentence']) && 
            isset($this->params['url']['right_answer']) && 
            isset($this->params['url']['wrong_answer1']) && 
            isset($this->params['url']['wrong_answer2']) && 
            isset($this->params['url']['wrong_answer3']) && 
            isset($this->params['url']['description']) && 
            isset($this->params['url']['category_id']) && 
            isset($this->params['url']['subcategory_id']) && 
            isset($this->params['url']['type'])){

            if($this->params['url']['kentei_id'] != null && 
                $this->params['url']['user_id'] != null && 
                $this->params['url']['sentence'] != null && 
                $this->params['url']['right_answer'] != null && 
                $this->params['url']['wrong_answer1'] != null && 
                $this->params['url']['wrong_answer2'] != null && 
                $this->params['url']['wrong_answer3'] != null && 
                $this->params['url']['description'] != null && 
                $this->params['url']['category_id'] != null && 
                $this->params['url']['subcategory_id'] != null && 
                $this->params['url']['type'] != null){

                $response = $this->success(array("type" => $this->params['url']['type'],
                                                    "kentei_id" => $this->params['url']['kentei_id'], 
                                                    "user_id" => $this->params['url']['user_id'], 
                									"sentence"  => $this->params['url']['sentence'], 
                									"right_answer" => $this->params['url']['right_answer'], 
                									"wrong_answer1" => $this->params['url']['wrong_answer1'], 
                									"wrong_answer2" => $this->params['url']['wrong_answer2'], 
                									"wrong_answer3" => $this->params['url']['wrong_answer3'], 
                									"description" => $this->params['url']['description'], 
                									"category_id" => $this->params['url']['category_id'], 
                									"subcategory_id" => $this->params['url']['subcategory_id']));


            }else{
                $response = array("code" => 401, "message" => "認証が失敗しているか、未認証の状態です。");
            }
        }else{
            $response = array("code" => 401, "message" => "認証が失敗しているか、未認証の状態です。");
        }

        $this->set('response', $response);

    }

    public function success($response = array()){
        $result["meta"] = array("method" => "GET", "url" => "/LK_API/problems/index.json");

        $result["response"] = array("code" => 200, "messae" => "リクエストに成功しました。");

        $result["response"]["Problem"] = $this->CreateQuiz->Parameter($response);

        return $result;
    }


}