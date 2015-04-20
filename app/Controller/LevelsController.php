<?php
App::uses('ApiController', 'Controller');
class LevelsController extends ApiController {
    public $name = "Levels";
    public $uses = array('Level');
    public $layout = null;

    public function index(){
        $this->Level->set($this->request->query);
        if($this->Level->validates()){
            $conditions = $this->createConditions($this->request->query);
            $findItems = $this->Level->find("all",array("conditions" => $conditions));
            $items = array();
            for($i = 0;$i < count($findItems);$i++){
                $items = $findItems[$i];
            }
            $items += array("code" => 200, "message" => "リクエストに成功しました。");
            return $this->success($items);
        }
        return $this->validationError("Level",$this->Level->validationErrors);
    }

     public function createConditions($querys) {
        $conditions = array();
        foreach($querys as $key => $query){
          $conditions[] = array("Level.".$key => $query);
        }
        return $conditions;
    }

    public function edit($id = null) {
        //idは数字のみ受け付ける
        $isIntNum = preg_match("/^[0-9]+$/",$id);
        $this->Level->set($this->request->data);
        if($this->Level->validates(array("fieldList" => array("user_id"))) && !empty($isIntNum)){
            $this->Level->id = $id;
            $this->Level->save($this->request->data, false);
            $this->request->data = array("code" => 201, "message" => "作成に成功しました。") + $this->request->data;
            return $this->success($this->request->data);
        }
        return $this->validationError("Level", $this->Level->validationErrors);
    }

}