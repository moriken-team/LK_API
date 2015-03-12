<?php
App::uses('AppController', 'Controller');

class GetQuizAllsController extends AppController {
	public $name = "GetQuizAlls";
	public $uses = array('GetQuizAll');

	public $components = array('RequestHandler');

    public $result = array();

    public function index(){
        if($this->params['url']['user_id'] != null && 
            $this->params['url']['employ'] != null && 
            $this->params['url']['grade'] != null){

            $response = $this->success(array("user_id" => $this->params['url']['user_id'], "employ"  => $this->params['url']['employ'], "grade" => $this->params['url']['grade']));


        }else{
            $response = array("code" => 401, "message" => "認証が失敗しているか、未認証の状態です。");
        }
        // debug($response);
        $this->set('response', $response);

    }

    public function success($response = array()){
        $result = array("code" => 200, "messae" => "リクエストに成功しました。");

        $result["Problem"] = $this->GetQuizAll->Parameter($response);
        // debug($result["Problem"]);
        return $result;

        // return $result['response'] = $response;

    }

}