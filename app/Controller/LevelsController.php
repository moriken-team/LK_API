<?php
App::uses('AppController', 'Controller');

class LevelsController extends AppController {
	public $name = "Levels";
	public $uses = array('Level');

	public $components = array('RequestHandler');

    public $result = array();

    public function index(){
        if(isset($this->params['url']['kentei_id']) && 
            isset($this->params['url']['user_id'])){

            if($this->params['url']['kentei_id'] != null && 
                $this->params['url']['user_id'] != null){

                $response = $this->success(array("kentei_id" => $this->params['url']['kentei_id'], "user_id"  => $this->params['url']['user_id']));


            }else{
                $response = array("code" => 401, "message" => "認証が失敗しているか、未認証の状態です。");
            }
        }else{
            $response = array("code" => 401, "message" => "認証が失敗しているか、未認証の状態です。");
        }

        $this->set('response', $response);

    }

    public function success($response = array()){
        $result["meta"] = array("method" => "GET", "url" => "/LK_API/levels/index.json");

        $result["response"] = array("code" => 200, "messae" => "リクエストに成功しました。");

        $result["response"]["Levels"] = $this->Level->Parameter($response);

        return $result;
    }

}