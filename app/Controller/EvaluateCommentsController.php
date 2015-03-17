<?php
App::uses("ApiController","Controller");
class EvaluateCommentsController extends ApiController {
    public $name = "EvaluateComments";
    public $uses = array("EvaluateComment");
    public $layout = null;

    public function add() {
        $postParams["EvaluateComment"] = $this->request->data;
        if($this->EvaluateComment->save($postParams)){
            $postParams += array("code" => 201, "message" => "作成に成功しました。");
            return $this->success($postParams);
        }
        return $this->validationError("EvaluateComment",$this->EvaluateComment->validationErrors);
    }

    public function index() {
        $this->EvaluateComment->set($this->request->query);
        $this->deleteValidFields($this->request->query);
        if($this->EvaluateComment->validates()){
            $conditions = $this->createConditions($this->request->query);
            $findComments = $this->EvaluateComment->find("all",array("conditions" => $conditions));
            $comments["EvaluateComments"] = array();
            for($i = 0;$i < count($findComments);$i++){
                $comments["EvaluateComments"][$i] = $findComments[$i];
            }
            $comments += array("code" => 200, "message" => "リクエストに成功しました。");;
            return $this->success($comments);
        }
        return $this->validationError("EvaluateComment", $this->EvaluateComment->validationErrors);
    }

    public function deleteValidFields($querys) {
        //APIの仕様に準ずる(APIドキュメント参照)
        unset($this->EvaluateComment->validate["evaluate_item_id"]["notEmpty"]);
        unset($this->EvaluateComment->validate["evaluate_comment"]["notEmpty"]);
        if(isset($querys["problem_id"])){
            unset($this->EvaluateComment->validate["user_id"]["notEmpty"]["required"]);
        }
        if(isset($querys["user_id"])){
            unset($this->EvaluateComment->validate["problem_id"]["notEmpty"]["required"]);
        }
    }

    public function createConditions($querys) {
        $conditions = array();
        foreach($querys as $key => $query){
            $conditions[] = array("EvaluateComment.".$key => $query);
        }
        return $conditions;
    }
}
