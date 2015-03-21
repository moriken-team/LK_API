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
}
