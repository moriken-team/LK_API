<?php
App::uses('AppController', 'Controller');
class AnswerHistoriesController extends AppController {
    public $name = "AnswerHistories";
    public $uses = array("AnswerHistory");
    public $layout = null;
    var $components = array('RequestHandler');

    public function create() {
        if($this->request->is("post")){
            $status =  $this->postSuccess($this->request->data);
        }else{
            $status = array("code" => 401, "message" => "認証が失敗しているか、未認証の状態です。");
        }
        $this->set("status", $status);
    }

    public function postSuccess($request_params){
        try{
            $post_params["AnswerHistory"] = $this->AnswerHistory->makeParameter($request_params);
            $this->AnswerHistory->save($post_params);
            $post_params["AnswerHistory"] += array("code" => 200, "messae" => "リクエストに成功しました。");
            return $post_params;
        }catch(Exception $e){
            return array("code" => 400, "message" => "未入力の項目があるか、入力内容が間違っています。");
        }
    }
}
