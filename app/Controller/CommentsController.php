<?php
App::uses("ApiController","Controller");
class CommentsController extends ApiController {
    public $name = "Comments";
    public $uses = array("Comment");
    public $layout = null;

    public function add() {
        $postParams["Comment"] = $this->request->data;
        if($this->Comment->save($postParams)){
            $postParams += array("code" => 201,"message" => "作成に成功しました。");
            return $this->success($postParams);
        }
        return $this->validationError("Comment",$this->Comment->validationErrors);
    }

    public function index() {
        $this->Comment->set($this->request->query);
        $this->deleteValidItem($this->request->query);
        if($this->Comment->validates()){
            $conditions = $this->createConditions($this->request->query);
            $findComments = $this->Comment->find("all",array("conditions" => $conditions));
            return $this->success($findComments);
        }
        return $this->validationError("Comment",$this->Comment->validationErrors);
    }

    public function deleteValidItem($querys) {
        unset($this->Comment->validate["comment"]);
        if(!isset($querys["from_user_id"])){
            unset($this->Comment->validate["from_user_id"]);
        }
    }

    public function createConditions($querys) {
        $conditions = array();
        foreach($querys as $key => $query){
            $conditions += array("Comment.".$key => $query);
        }
        return $conditions;
    }
}
