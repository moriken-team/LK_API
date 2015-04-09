<?php
App::uses('AppModel', 'Model');
class AnswerHistory extends AppModel {

    public $name = "AnswerHistory";
    public $post_params = array();
    public $parameters = array("kentei_id", "problem_id", "user_id", "answer_flag", "answer_text");
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
        "answer_flag" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "required" => true,
                "message" => "answer_flagを設定してください"
            ),
            "Numeric" => array(
                "rule" => "Numeric",
                "message" => "正しいanswer_flag(int)を設定してください"
            )
        )
    );

}
