<?php
App::uses("AppModel","Model");
class Level extends AppModel {
    public $name = "Level";
    public $validate = array(
        "user_id" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "required" => true,
                "message" => "user_idを設定してください"
            ),
            "Numeric" => array(
                "rule" => "Numeric",
                "message" => "正しいuser_id(int)を設定してください"
            )
        )
    );
}