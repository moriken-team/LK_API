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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid %s', __('user')));
		}
		$this->set('user', $this->User->read(null, $id));
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
            //$this->request->data['User'] = array_merge($this->request->data['User'], array('id' => $id));
            //$this->Auth->login($this->request->data['User']);

            $udata = $this->User->findById($id);
            //$udata['User']['password'] = $this->request->data['User']['password'];
            unset($udata['User']['password']);

            return $this->success(
                array(
                    'code' => 201, 
                    'message' => 'ユーザ登録に成功しました。',
                    'response' => $udata['User'], 
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
