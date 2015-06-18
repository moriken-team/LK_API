<?php
App::uses("AppModel", "Model");
class Spot extends AppModel {
    public $name = "Spot";
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
        ),
        "create_user_id" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "required" => true,
                "message" => "create_user_idを設定してください"
            ),
            "Numeric" => array(
                "rule" => "Numeric",
                "message" => "正しいcreate_user_id(int)を設定してください"
            )
        ),
        "latitude" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "required" => true,
                "message" => "latitudeを設定してください"
            ),
            "decimal" => array(
                "rule" => "decimal",
                "message" => "正しいlatitude(float)を設定してください"
            )
        ),
        "longitude" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "required" => true,
                "message" => "longitudeを設定してください"
            ),
            "decimal" => array(
                "rule" => "decimal",
                "message" => "正しいlongitude(float)を設定してください"
            )
        )
    );
}
