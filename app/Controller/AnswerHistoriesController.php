<?php
App::uses('ApiController', 'Controller');
class AnswerHistoriesController extends ApiController {
    public $name = "AnswerHistories";
    public $uses = array("AnswerHistory");
    public $layout = null;

    public function add() {
        $post_params["AnswerHistory"] = $this->request->data;
        if($this->AnswerHistory->save($post_params)){
            $post_params += array("code" => 201, "message" => "作成に成功しました。");
            return $this->success($post_params);
        }else{
            return $this->validationError("AnswerHistory", $this->AnswerHistory->validationErrors);
        }
    }

    public function index() {
        //if(isset($this->request->query()){
        //    return $this->success(array("message" => ));
        //}
        $this->AnswerHistory->set($this->request->query);
        unset($this->AnswerHistory->validate["problem_id"]["notEmpty"]);
        unset($this->AnswerHistory->validate["answer_flag"]["notEmpty"]);
        if($this->AnswerHistory->validates()){
            $findConditions = array(
                                    "AnswerHistory.kentei_id" => $this->request->data["kentei_id"],
                                    "AnswerHistory.user_id" => $this->request->data["user_id"]
                                   );
            if(isset($this->request->data["answer_flag"])){
                $findConditions = array("AnswerHistory.answer_flag" => $this->request->data["answer_flag"]);
            }
            $findRespons = $this->AnswerHistory->find("all",array("conditions" => $findConditions));
            $findRespons += array("code" => 200, "message" => "リクエストに成功しました。");
            return $this->success($findRespons);
        }else{
            return $this->validationError("AnswerHistory", $this->AnswerHistory->validationErrors);
        }
    }
}
