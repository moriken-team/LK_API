<?php
App::uses("ApiController","Controller");
class EvaluateItemsController extends ApiController {
    public $name = "EvaluateItems";
    public $uses = array("EvaluateItem");
    public $layout = null;

    public function index() {
        $this->EvaluateItem->set($this->request->query);
        if($this->EvaluateItem->validates()){
            $conditions = $this->createConditions($this->request->query);
            $findItems = $this->EvaluateItem->find("all",array("conditions" => $conditions));
            $items["EvaluateItems"] = array();
            for($i = 0;$i < count($findItems);$i++){
                $items["EvaluateItems"][$i] = $findItems[$i];
            }
            $items += array("code" => 200, "message" => "リクエストに成功しました。");
            return $this->success($items);
        }
        return $this->validationError("EvaluateItem",$this->EvaluateItem->validationErrors);
    }

    public function createConditions($querys) {
        $conditions = array();
        foreach($querys as $key => $query){
          $conditions[] = array("EvaluateItem.".$key => $query);
        }
        return $conditions;
    }
}
