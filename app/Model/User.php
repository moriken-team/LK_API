<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
//App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
/**
 * User Model
 *
 * @property Twitter $Twitter
 * @property Facebook $Facebook
 * @property MorikenAuth $MorikenAuth
 * @property Activity $Activity
 * @property AnswerHistory $AnswerHistory
 * @property Level $Level
 * @property Problem $Problem
 */
class User extends AppModel {

/**
 * before save method
 */
    public function beforeSave($options = array()){
        if (!$this->id) {
            //$passwordHasher = new BlowfishPasswordHasher();
            $passwordHasher = new SimplePasswordHasher();

            $this->data['User']['password'] = $passwordHasher->hash($this->data['User']['password']);
        }
        return true;
    }

    /**
     * Check token method
     *
     * @param $token token key
     * @return boolean
     */
    public function checkToken($token){
        if ($this->find('first', array('conditions' => array('token' => $token)))){
            return true
        }else{
            return false;
        }
    }

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'username' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
//	public $belongsTo = array(
//		'Twitter' => array(
//			'className' => 'Twitter',
//			'foreignKey' => 'twitter_id',
//			'conditions' => '',
//			'fields' => '',
//			'order' => ''
//		),
//		'Facebook' => array(
//			'className' => 'Facebook',
//			'foreignKey' => 'facebook_id',
//			'conditions' => '',
//			'fields' => '',
//			'order' => ''
//		),
//	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Activity' => array(
			'className' => 'Activity',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'AnswerHistory' => array(
			'className' => 'AnswerHistory',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Level' => array(
			'className' => 'Level',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Problem' => array(
			'className' => 'Problem',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
