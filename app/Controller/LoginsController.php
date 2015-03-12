<?php
App::uses('ApiController', 'Controller');
/**
 * Login Controller
 *
 */
class LoginsController extends ApiController {

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
            $this->loadModel('User');
			if ($response = $this->User->find('first', $this->request->data)) {
                return $this->success(
                    array(
                        'code' => 200, 
                        'message' => 'ログインに成功しました。',
                        'response' => $response,
                    )
                );
            } else {
                return $this->error('ログインに失敗しました。ユーザ名（メールアドレス）かパスワードを確認して下さい。', 401);
			}
		}
	}
}
