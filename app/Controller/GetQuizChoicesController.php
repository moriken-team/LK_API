<?php
App::uses('AppController', 'Controller');

class GetQuizChoicesController extends AppController {
	public $name = "GetQuizChoices";
	public $uses = array('GetQuizChoice');

	public $components = array('RequestHandler');


	public $result = array();


    public function show(){
        //指定されているリクエストパラメータが入力していたら
        if (isset($this->params['url']['kentei_id']) && 
            isset($this->params['url']['employ']) &&
            isset($this->params['url']['item'])) {
        
            if($this->params['url']['kentei_id'] != null && 
                $this->params['url']['employ'] != null && 
                $this->params['url']['item'] != null){

                if(isset($this->params['url']['category_id'])){//リクエストパラメータが「category_id」の場合
                    $response = $this->oneSuccess(array("kentei_id" => $this->params['url']['kentei_id'], "employ"  => $this->params['url']['employ'], "category_id" => $this->params['url']['category_id'], "item" => $this->params['url']['item']));

                }elseif(isset($this->params['url']['grade'])){//リクエストパラメータが「grade」の場合
                    $response = $this->oneSuccess(array("kentei_id" => $this->params['url']['kentei_id'], "employ"  => $this->params['url']['employ'], "grade" => $this->params['url']['grade'], "item" => $this->params['url']['item']));
                }elseif(isset($this->params['url']['category_id']) && isset($this->params['url']['grade'])) {
                    $response = $this->oneSuccess(array("kentei_id" => $this->params['url']['kentei_id'], "employ"  => $this->params['url']['employ'], "category_id" => $this->params['url']['category_id'], "grade" => $this->params['url']['grade'], "item" => $this->params['url']['item']));
                }
                
            }else{
                $response = array("code" => 401, "message" => "認証が失敗しているか、未認証の状態です。");
            }

        }else{
            $response = array("code" => 401, "message" => "認証が失敗しているか、未認証の状態です。");
        }

        $this->set('response', $response);
    }

    public function oneSuccess($response = array()){
        $result["meta"] = array("method" => "GET", "url" => "/LK_API/problems/index.json");

        $result["response"] = array("code" => 200, "messae" => "リクエストに成功しました。");

        $result["response"]["Problems"] = $this->GetQuizChoice->oneParameter($response);

        return $result;
    }






    public function randomshow(){
        //指定されているリクエストパラメータが入力していたら
        if($this->params['url']['kentei_id'] != null && 
            $this->params['url']['employ'] != null && 
            $this->params['url']['item'] != null){

            if(isset($this->params['url']['category_id'])){//リクエストパラメータが「category_id」の場合
                $response = $this->fiveSuccess(array("kentei_id" => $this->params['url']['kentei_id'], "employ"  => $this->params['url']['employ'], "category_id" => $this->params['url']['category_id'], "item" => $this->params['url']['item']));

            }elseif(isset($this->params['url']['grade'])){//リクエストパラメータが「grade」の場合
                $response = $this->fiveSuccess(array("kentei_id" => $this->params['url']['kentei_id'], "employ"  => $this->params['url']['employ'], "grade" => $this->params['url']['grade'], "item" => $this->params['url']['item']));
            }elseif(isset($this->params['url']['category_id']) && isset($this->params['url']['grade'])) {
                $response = $this->fiveSuccess(array("kentei_id" => $this->params['url']['kentei_id'], "employ"  => $this->params['url']['employ'], "category_id" => $this->params['url']['category_id'], "grade" => $this->params['url']['grade'], "item" => $this->params['url']['item']));
            }

        }else{
            $response = array("code" => 401, "message" => "認証が失敗しているか、未認証の状態です。");
        }

        $this->set('response', $response);

    }

    public function fiveSuccess($response = array()){
        $result["meta"] = array("method" => "GET", "url" => "/LK_API/problems/index.json");

        $result["response"] = array("code" => 200, "messae" => "リクエストに成功しました。");

        $result["response"]["Problems"] = $this->GetQuizChoice->fiveParameter($response);

        return $result;

    }

}