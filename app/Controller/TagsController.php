<?php
App::uses("ApiController","Controller");
class TagsController extends ApiController {
    public $name = "Tags";
    public $uses = array("Tag");
    public $layout = null;

    public function add() {
        $postParams["Tag"] = $this->request->data;
        if($this->Tag->save($postParams)){
            $postParams += array("code" => 201, "message" => "作成に成功しました。");
            return $this->success($postParams);
        }
        return $this->validationError("Tag", $this->Tag->validationErrors);
    }
}
