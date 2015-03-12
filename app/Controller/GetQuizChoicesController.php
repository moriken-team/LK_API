<?php
App::uses('AppController', 'Controller');

class GetQuizChoicesController extends AppController {
	public $name = "GetQuizChoices";
	public $uses = array('GetQuizChoice');

	public $components = array('RequestHandler');


	public $result = array();


    public function show(){
        if($this->params['url']['user_id'] != null && 
            $this->params['url']['employ'] != null && 
            $this->params['url']['grade'] != null &&
            $this->params['url']['item'] != null){

            $response = $this->oneSuccess(array("user_id" => $this->params['url']['user_id'], "employ"  => $this->params['url']['employ'], "grade" => $this->params['url']['grade'], "item" => $this->params['url']['item']));


        }else{
            $response = array("code" => 401, "message" => "認証が失敗しているか、未認証の状態です。");
        }
        // debug($response);
        $this->set('response', $response);

    }

    public function oneSuccess($response = array()){
        $result = array("code" => 200, "messae" => "リクエストに成功しました。");

        $result["Problem"] = $this->GetQuizChoice->oneParameter($response);
    	// debug($result["Problem"]);
        return $result;

        // return $result['response'] = $response;

    }






    public function randomshow(){
        if($this->params['url']['user_id'] != null && 
            $this->params['url']['employ'] != null && 
            $this->params['url']['grade'] != null &&
            $this->params['url']['item'] != null){

            $response = $this->fiveSuccess(array("user_id" => $this->params['url']['user_id'], "employ"  => $this->params['url']['employ'], "grade" => $this->params['url']['grade'], "item" => $this->params['url']['item']));


        }else{
            $response = array("code" => 401, "message" => "認証が失敗しているか、未認証の状態です。");
        }
        // debug($response);
        $this->set('response', $response);

    }

    public function fiveSuccess($response = array()){

        $result = array("code" => 200, "messae" => "リクエストに成功しました。");

        $result["Problem"] = $this->GetQuizChoice->fiveParameter($response);
        // debug($result["Problem"]);
        return $result;

        // return $result['response'] = $response;

    }

}