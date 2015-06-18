<?php
App::uses("ApiController", "Controller");
class SpotsController extends ApiController {
    public $name = "Spots";
    public $uses = array("Spot");
    public $layout = null;

    public function add() {
        $postSpot = $this->request->data;
        if($this->Spot->save($postSpot)){
            $response["Spot"] = $postSpot;
            $response += array("code" => 201, "message" => "作成に成功しました。");
            return $this->success($response);
        }
        return $this->validationError("Spot",$this->Spot->validationErrors);
    }

    public function index() {
        $this->Spot->set($this->request->query);
        if($this->Spot->validates(array("fieldList" => array("kentei_id")))) {
            $conditions = $this->createConditions($this->request->query);
            $findSpots = $this->Spot->find("all", array("conditions" => $conditions));
            $response["Spots"] = array();
            foreach($findSpots as $number => $spot) {
                $response["Spots"][$number] = $spot;
            }
            $response += array("code" => 200, "message" => "リクエストに成功しました。");
            return $this->success($response);
        }
        return $this->validationError("Spot", $this->validationErrors);
    }

    public function createConditions($querys) {
        $conditions = array();
        foreach($querys as $column => $param) {
            $conditions[] = array("Spot.".$column => $param);
        }
        return $conditions;
    }
}
