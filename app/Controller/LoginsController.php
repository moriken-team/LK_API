<?php
App::uses('ApiController', 'Controller');
/**
 * Login Controller
 *
 */
class LoginsController extends ApiController {

    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('add');
    }
/**
 * add method
 *
 * @return void
 */
	public function add() {
        if ($this->Auth->login()) {
            return $this->success(
                array(
                    'code' => 200, 
                    'message' => 'ログインに成功しました。',
                    'response' => $this->Auth->user(),
                )
            );
        } else {
            return $this->error('ログインに失敗しました。ユーザ名（メールアドレス）かパスワードを確認して下さい。', 401);
        }
    }
}
