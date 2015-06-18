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
}
