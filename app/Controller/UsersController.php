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
        $this->Auth->allow('add');
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {

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
            $udata = $this->User->findById($id);
            $this->Auth->login($udata['User']); // 手動でログイン
            $loginUser = $this->Auth->user(); // パスワードを返さないようにunset（$this->Auth->login()に直接unsetするとエラーになったため
            unset($loginUser['password']);

            return $this->success(
                array(
                    'code' => 201, 
                    'message' => $this->statusCode[201],
                    'user' => $loginUser,
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
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid %s', __('user')));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(
					__('The %s has been saved', __('user')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
					)
				);
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
					__('The %s could not be saved. Please, try again.', __('user')),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					)
				);
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
		}
		$twitters = $this->User->Twitter->find('list');
		$facebooks = $this->User->Facebook->find('list');
		$morikenAuths = $this->User->MorikenAuth->find('list');
		$this->set(compact('twitters', 'facebooks', 'morikenAuths'));
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

}
