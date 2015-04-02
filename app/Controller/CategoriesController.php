<?php
App::uses("ApiController","Controller");
class CategoriesController extends ApiController {
    public $name = "Categories";
    public $uses = array("Category");
    public $layout = null;

    public function add() {
        $postParams["Category"] = $this->request->data;
        if($this->Category->save($postParams)){
            $postParams += array("code" => 201, "message" => "作成に成功しました");
            return $this->success($postParams);
        }
        return $this->validationError("Category",$this->Category->validationErrors);
    }
}
