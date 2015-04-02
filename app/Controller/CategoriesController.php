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

    public function index() {
        $this->Category->set($this->request->query);
        unset($this->Category->validate["name"]["notEmpty"]);
        if($this->Category->validates()){
            $conditions = $this->createConditions($this->request->query);
            $findCategories = $this->Category->find("all",array("conditions" => $conditions));
            $categories["Categories"] = array();
            foreach($findCategories as $category){
                $categories["Categories"][] = $category;
            }
            $categories += array("code" => 200, "message" => "リクエストに成功しました。");
            return $this->success($categories);
        }
        return $this->validationError("Category",$this->Category->validationErrors);
    }

    public function createConditions($querys) {
        $conditions = array();
        foreach($querys as $key => $query){
            $conditions[] = array("Category.".$key => $query);
        }
        return $conditions;
    }
}
