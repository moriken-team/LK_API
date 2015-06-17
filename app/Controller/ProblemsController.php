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

    public function index() {
        $this->Problem->set($this->request->query);
        $validFields = $this->getValidFields($this->request->query);
        if($this->Problem->validates(array("fieldList" => $validFields))){
            $conditions = $this->createConditions($this->request->query);
            if($this->request->query["item"] == 100){
                $problems = $this->createAscProblems($this->request->query, $conditions);
            }else{
                $problems = $this->createRandomProblems($this->request->query, $conditions);
            }
            $problems += array("code" => 200, "message" => "リクエストに成功しました。");
            return $this->success($problems);
        }
        return $this->validationError("Problem",$this->Problem->validationErrors);
    }

    public function getValidFields($querys) {
        //user_idは任意項目とする
        unset($this->Problem->validate["user_id"]["notEmpty"]);
        //カテゴリーID,級,年度がない場合は、ランダム取得(APIドキュメント参照)
        if(!isset($query["employ"]) && !isset($query["category_id"]) && !isset($query["grade"])){
            unset($this->Problem->validate["employ"]["notEmpty"]);
            unset($this->Problem->validate["category_id"]["notEmpty"]);
            unset($this->Problem->validate["grade"]["notEmpty"]);
            return array("kentei_id","user_id","employ","category_id","item","public_flag");
        }
        //APIの仕様に準ずる(APIドキュメント参照)
        if(isset($querys["employ"]) && $querys["employ"] == OriginalQuestions){
            unset($this->Problem->validate["category_id"]["notEmpty"]);
            return array("kentei_id","user_id","employ","category_id","item","public_flag");
        }
        //過去問はpublic_flagを任意項目にする
        unset($this->Problem->validate["public_flag"]["notEmpty"]);
        if(isset($querys["category_id"])){
            return array("kentei_id","user_id","employ","category_id","item","public_flag");
        }
        return array("kentei_id","user_id","employ","grade","item","public_flag");
    }

    public function createConditions($querys) {
        $conditions = array();
        unset($querys["item"]);
        foreach($querys as $key => $query){
            $conditions[] = array("Problem.".$key => $query);
        }
        return $conditions;
    }

    public function createAscProblems($querys, $conditions) {
        //オリジナル問題は作成日,過去問は設問番号の昇順で取得(APIドキュメント参照)
        $orderField = $querys["employ"] == OriginalQuestions ? "created" : "number";
        $orderItem = array("Problem.".$orderField => "asc");
        $findProblems = $this->Problem->find("all", array("conditions" => $conditions, "order" => $orderItem));
        //findされた問題を整理
        $problems["Problems"] = array();
        for($i = 0;$i < count($findProblems);$i++){
            $problems["Problems"][$i] = $findProblems[$i];
        }
        return $problems;
    }

    public function createRandomProblems($querys, $conditions) {
        $findProblems = array();
        $findTargetIds = $this->Problem->find("list",array("conditions" => $conditions));
        for($i = 0;$i < $querys["item"] && !empty($findTargetIds);$i++){
            $randInt = array_rand($findTargetIds);
            $randomConditions = array("Problem.id" => $randInt);
            $findProblems[] = $this->Problem->find("all", array("conditions" => $randomConditions));
            unset($findTargetIds[$randInt]);
        }
        $problems = array();
        for($i = 0;$i < count($findProblems);$i++){
            $problems["Problems"][$i] = $findProblems[$i][0];
        }
        return $problems;
    }

    public function add() {
        $post_params["Problem"] = $this->request->data;
        //問題形式の違いによるバリデーション項目の操作
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
        unset($this->Problem->validate["item"]);
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

    public function edit($id = null) {
        $this->Problem->set($this->request->data);
        unset($this->Problem->validate['public_flag']['notEmpty']);
        $validateFields = array('public_flag','latitude', 'longitude');
        if(is_numeric($id) && $this->Problem->validates(array("fieldList" => $validateFields))){
            $this->Problem->id = $id;
            $this->Problem->save($this->request->data, false);
            foreach($this->request->data as $key => $postData){
                $postParams["Problem"][$key] = $postData;
            }
            $postParams += array("code" => 201, "message" => "作成に成功しました。");
            return $this->success($postParams);
        }
        return $this->validationError("Problem", $this->Problem->validationErrors);
    }
}
