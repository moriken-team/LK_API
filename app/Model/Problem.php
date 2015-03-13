<?php
App::uses("AppModel", "Model");
class Problem extends AppModel {
    public $name = "Problem";
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
        "type" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "required" => true,
                "message" => "typeを設定してください"
            ),
            "Numeric" => array(
                "rule" => "Numeric",
                "message" => "正しいtype(int)を設定してください"
            )
        ),
        "grade" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "required" => true,
                "message" => "gradeを設定してください"
            ),
            "Numeric" => array(
                "rule" => "Numeric",
                "message" => "正しいgrade(int)を設定してください"
            )
        ),
        "number" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "required" => true,
                "message" => "numberを設定してください"
            ),
            "Numeric" => array(
                "rule" => "Numeric",
                "message" => "正しいnumber(int)を設定してください"
            )
        ),
        "sentence" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "required" => true,
                "message" => "sentenceを設定してください"
            )
        ),
        "right_answer" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "required" => true,
                "message" => "right_answerを設定してください"
            )
        ),
        "wrong_answer1" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "required" => true,
                "message" => "wrong_answer1を設定してください"
            )
        ),
        "wrong_answer2" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "required" => true,
                "message" => "wrong_answer2を設定してください"
            )
        ),
        "wrong_answer3" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "required" => true,
                "message" => "wrong_answer3を設定してください"
            )
        ),
        "description" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "required" => true,
                "message" => "descriptionを設定してください"
            )
        ),
        "other_answer" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "message" => "other_answerを設定してください"
            )
        ),
        "image" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "message" => "imageを設定してください"
            )
        ),
        "latitude" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
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
                "message" => "longitudeを設定してください"
            ),
            "decimal" => array(
                "rule" => "decimal",
                "message" => "正しいlongitude(float)を設定してください"
            )
        ),
        "spot_id" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "message" => "spot_idを設定してください"
            ),
            "Numeric" => array(
                "rule" => "Numeric",
                "message" => "正しいspot_id(int)を設定してください"
            )
        ),
        "public_flag" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "required" => true,
                "message" => "public_flagを設定してください"
            ),
            "Numeric" => array(
                "rule" => "Numeric",
                "message" => "正しいpublic_flag(int)を設定してください"
            )
        ),
        "category_id" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "required" => true,
                "message" => "category_idを設定してください"
            ),
            "Numeric" => array(
                "rule" => "Numeric",
                "message" => "正しいcategory_id(int)を設定してください"
            )
        ),
        "subcategory_id" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "message" => "subcategory_idを設定してください"
            ),
            "Numeric" => array(
                "rule" => "Numeric",
                "message" => "正しいsubcategory_id(int)を設定してください"
            )
        )
        //"item" => array(
        //    "Numeric" => array(
        //        "rule" => "Numeric",
        //        "message" => "正しいitem(int)を設定してください"
        //    )
        //)
    );
}
