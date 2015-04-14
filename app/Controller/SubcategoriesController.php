<?php
App::uses("ApiController","Controller");
class SubcategoriesController extends ApiController {
    public $name = "Subcategories";
    public $uses = array("Subcategory");
    public $layout = null;

    public function add() {
        $postParams["Subcategory"] = $this->request->data;
        if($this->Subcategory->save($this->request->data)){
            $postParams += array("code" => 201,"message" => "作成に成功しました。");
            return $this->success($postParams);
        }
        return $this->validationError("Subcategory", $this->Subcategory->validationErrors);
    }
}
