<?php
App::uses("ApiController","Controller");
class ProblemsController extends ApiController {
    public $name = "Problems";
    public $uses = array("Problem");
    public $layout = null;

    public function add() {
        $post_params["Problem"] = $this->request->data;
        //記述形式の場合は誤答選択肢のバリデーション項目を削除
        if(isset($post_params["Problem"]["type"]) && $post_params["Problem"]["type"] == 2){
            unset($this->Problem->validate["wrong_answer1"]["notEmpty"]);
            unset($this->Problem->validate["wrong_answer2"]["notEmpty"]);
            unset($this->Problem->validate["wrong_answer3"]["notEmpty"]);
        }
        if($this->Problem->save($post_params)){
            $post_params += array("code" => 201, "message" => "作成に成功しました。");
            return $this->success($post_params);
        }else{
            return $this->validationError("Problem",$this->Problem->validationErrors);
        }
    }
}
