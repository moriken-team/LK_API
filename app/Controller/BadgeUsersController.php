<?php
App::uses('ApiController', 'Controller');
/**
 * BadgeUsers Controller
 *
 * @property BadgeUser $BadgeUser
 */
class BadgeUsersController extends ApiController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->BadgeUser->recursive = 0;
        $userId = $this->request->query['userid'];
        $response = $this->BadgeUser->find('all', array('conditions' => array('user_id' => $userId)));

        return $this->success(
            array(
                'code' => 200,
                'response' => $response,
            )
        );
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->BadgeUser->exists($id)) {
			throw new NotFoundException(__('Invalid badge user'));
		}
		$options = array('conditions' => array('BadgeUser.' . $this->BadgeUser->primaryKey => $id));
		$this->set('badgeUser', $this->BadgeUser->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->BadgeUser->create();
			if ($this->BadgeUser->save($this->request->data)) {
				$this->Session->setFlash(__('The badge user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The badge user could not be saved. Please, try again.'));
			}
		}
		$badges = $this->BadgeUser->Badge->find('list');
		$users = $this->BadgeUser->User->find('list');
		$this->set(compact('badges', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->BadgeUser->exists($id)) {
			throw new NotFoundException(__('Invalid badge user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->BadgeUser->save($this->request->data)) {
				$this->Session->setFlash(__('The badge user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The badge user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('BadgeUser.' . $this->BadgeUser->primaryKey => $id));
			$this->request->data = $this->BadgeUser->find('first', $options);
		}
		$badges = $this->BadgeUser->Badge->find('list');
		$users = $this->BadgeUser->User->find('list');
		$this->set(compact('badges', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->BadgeUser->id = $id;
		if (!$this->BadgeUser->exists()) {
			throw new NotFoundException(__('Invalid badge user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->BadgeUser->delete()) {
			$this->Session->setFlash(__('The badge user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The badge user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
