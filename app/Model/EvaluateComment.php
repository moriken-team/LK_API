<?php
App::uses("AppModel", "Model");
class EvaluateComment extends AppModel {
    public $name = "EvaluateComment";
    public $validate = array(
        "evaluate_item_id" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "required" => true,
                "message" => "evaluate_item_idを設定してください"
            ),
            "Numeric" => array(
                "rule" => "Numeric",
                "message" => "正しいevaluate_item_id(int)を設定してください"
            )
        ),
        "problem_id" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "required" => true,
                "message" => "problem_idを設定してください"
            ),
            "Numeric" => array(
                "rule" => "Numeric",
                "message" => "正しいproblem_id(int)を設定してください"
            )
        ),
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
        "evaluate_comment" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "required" => true,
                "message" => "evaluate_commentを設定してください"
            )
        )
    );
}
