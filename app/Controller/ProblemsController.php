<?php
App::uses("ApiController","Controller");
class ProblemsController extends ApiController {
    public $name = "Problems";
    public $uses = array("Problem");
    public $layout = null;

    public function add() {
        $post_params["Problem"] = $this->request->data;
        if($this->Problem->save($post_params)){
            $post_params += array("code" => 201, "message" => "作成に成功しました。");
            return $this->success($post_params);
        }else{
            return $this->validationError("Problem",$this->Problem->validationErrors);
        }
    }
}
