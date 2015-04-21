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
        ),
        "use_level" => array(
            "Numeric" => array(
                "rule" => "Numeric",
                "message" => "正しいuse_level(int)を設定してください"
            )
        ),
        "know_level" => array(
            "Numeric" => array(
                "rule" => "Numeric",
                "message" => "正しいknow_level(int)を設定してください"
            )
        ),
        "use_point" => array(
            "Numeric" => array(
                "rule" => "Numeric",
                "message" => "正しいuse_point(int)を設定してください"
            )
        ),
        "login_point" => array(
            "Numeric" => array(
                "rule" => "Numeric",
                "message" => "正しいlogin_pointを設定してください"
            )
        ),
        "answer_point" => array(
            "Numeric" => array(
                "rule" => "Numeric",
                "message" => "正しいanswer_pointを設定してください"
            )
        ),
        "make_point" => array(
            "Numeric" => array(
                "rule" => "Numeric",
                "message" => "正しいmake_pointを設定してください"
            )
        ),
        "evaluate_point" => array(
            "Numeric" => array(
                "rule" => "Numeric",
                "message" => "正しいevaluate_pointを設定してください"
            )
        ),
    );
}