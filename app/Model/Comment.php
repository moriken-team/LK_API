<?php
App::uses("AppModel","Model");
class Comment extends AppModel {
    public $name = "Comment";
    public $belongsTo = array(
        "User" => array(
            "className" => "User",
            "foreignKey" => "from_user_id",
            "fields" => array("id","username","image")
        )
    );
    public $validate = array(
        "target" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "required" => true,
                "message" => "targetを設定してください"
            ),
            "Numeric" => array(
                "rule" => "Numeric",
                "message" => "正しいtarget(int)を設定してください"
            )
        ),
        "from_user_id" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "required" => true,
                "message" => "from_user_idを設定してください"
            ),
            "Numeric" => array(
                "rule" => "Numeric",
                "message" => "正しいfrom_user_id(int)を設定してください"
            )
        ),
        "to_action_id" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "required" => true,
                "message" => "to_action_idを設定してください"
            ),
            "Numeric" => array(
                "rule" => "Numeric",
                "message" => "正しいto_action_id(int)を設定してください"
            )
        ),
        "comment" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "required" => true,
                "message" => "commentを設定してください"
            )
        )
    );
}
