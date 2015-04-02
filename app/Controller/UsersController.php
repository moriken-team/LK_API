<?php
App::uses('ApiController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends ApiController {

    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow();
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
        $usdata = $this->User->find('all', array('conditions' => array($this->request->query)));
        return $this->success(
            array(
                'code' => 200,
                'message' => $this->statusCode[200],
                'data' => $usdata,
            )
        );
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
        $udata = $this->User->findById($id);
        return $this->success(
            array(
                'code' => 200,
                'message' => $this->statusCode[200],
                'data' => $udata,
            )
        );
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
        $this->User->create();
        $this->request->data['User']['token'] = Security::generateAuthKey();

        if ($this->User->save($this->request->data)) {
            $id = $this->User->id;
            // levelsテーブルもSave
            $levels['Level']['user_id'] = $id;
            $this->User->Level->save($levels);

            // response処理
            $udata = $this->User->findById($id);
            $this->Auth->login($udata['User']); // 手動でログイン
            $loginUser = $this->Auth->user(); // パスワードを返さないようにunset（$this->Auth->login()に直接unsetするとエラーになったため
            unset($loginUser['password']);

            return $this->success(
                array(
                    'code' => 201, 
                    'message' => $this->statusCode[201],
                    'data' => $loginUser,
                )
            );
        } else {
            return $this->validationError('User', $this->User->validationErrors);
        }
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
        $this->User->id = $id;
        if ($this->User->save($this->request->data)){
            $udata = $this->User->read(null, $id);
            unset($udata['User']['password']);
            return $this->success(
                array(
                    'code' => 200,
                    'message' => $this->statusCode[200],
                    'data' => $udata,
                )
            );
        }else{
            return $this->validationErrors('User', $this->User->validationErrors);
        }
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid %s', __('user')));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(
				__('The %s deleted', __('user')),
				'alert',
				array(
					'plugin' => 'TwitterBootstrap',
					'class' => 'alert-success'
				)
			);
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(
			__('The %s was not deleted', __('user')),
			'alert',
			array(
				'plugin' => 'TwitterBootstrap',
				'class' => 'alert-error'
			)
		);
		$this->redirect(array('action' => 'index'));
	}

/**
 * Confirm Email address(パスワード再発行処理用)
 *
 * この関数はWeb側で直接Actionを指定してもらって叩く。Restじゃ無理なので。
 */
    public function matchEmail(){
        $user = $this->User->find('first', array('conditions' => $this->request->data));
        if ($user){
            return $this->success(
                array(
                    'code' => 200, 
                    'message' => $this->statusCode[200],
                    'data' => $user['User'],
                )
            );
        }else{
            return $this->error($this->statusCode[404], 404);
        }
    }
}
