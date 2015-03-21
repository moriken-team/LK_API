<?php
App::uses("AppModel","Model");
class Category extends AppModel {
    public $name = "Category";
    public $validate = array(
        "kentei_id" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "required" => true,
                "message" => "kentei_idを設定してください"
            ),
            "Numeric" => array(
                "rule" => "Numeric",
                "message" => "正しいkentei_id(int)を設定してください"
            )
        ),
        "name" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "required" => true,
                "message" => "nameを設定してください"
            )
        )
    );
}
