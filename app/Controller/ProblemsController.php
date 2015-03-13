<?php
App::uses("ApiController","Controller");
define("SelectionProblemForm", 1);
define("QuestionsAndAnswersForm", 2);
define("ExistQuestions", 1);
define("OriginalQuestions", 0);
class ProblemsController extends ApiController {
    public $name = "Problems";
    public $uses = array("Problem");
    public $layout = null;

    public function add() {
        $post_params["Problem"] = $this->request->data;
        //記述形式の違いによるバリデーション項目の操作
        if(isset($post_params["Problem"]["type"]) && isset($post_params["Problem"]["public_flag"])){
            $this->unsetValidItem($post_params["Problem"]["type"], $post_params["Problem"]["public_flag"]);
        }
        if($this->Problem->save($post_params)){
            $post_params += array("code" => 201, "message" => "作成に成功しました。");
            return $this->success($post_params);
        }else{
            return $this->validationError("Problem",$this->Problem->validationErrors);
        }
    }

    public function unsetValidItem($type, $public_flag) {
        if($type == QuestionsAndAnswersForm){
            unset($this->Problem->validate["wrong_answer1"]["notEmpty"]);
            unset($this->Problem->validate["wrong_answer2"]["notEmpty"]);
            unset($this->Problem->validate["wrong_answer3"]["notEmpty"]);
        }

        if($public_flag == OriginalQuestions){
            unset($this->Problem->validate["grade"]["notEmpty"]);
            unset($this->Problem->validate["number"]["notEmpty"]);
        }
    }
}
