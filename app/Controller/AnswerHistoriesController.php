<?php
App::uses('ApiController', 'Controller');
class AnswerHistoriesController extends ApiController {
    public $name = "AnswerHistories";
    public $uses = array("AnswerHistory");
    public $layout = null;

    public function add() {
        if($this->request->is("post")){
            $post_params["AnswerHistory"] = $this->request->data;
            if($this->AnswerHistory->save($post_params)){
                $post_params += array("code" => 200, "message" => "リクエストに成功しました。");
                return $this->success($post_params);
            }else{
                return $this->validationError("AnswerHistory", $this->AnswerHistory->validationErrors);
            }
        }else{
            return $this->error("認証が失敗しているか、未認証の状態です。", 401);
        }
    }
}
