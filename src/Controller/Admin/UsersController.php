<?php
namespace DejwCake\StandardAuth\Controller\Admin;

use DejwCake\StandardAuth\Controller\Admin\AppController;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\ConflictException;
use Cake\Routing\Router;
use Cake\Event\Event;
use Cake\Log\Log;

/**
 * Users Controller
 *
 * @property \DejwCake\StandardAuth\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    /**
     * Before filter callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['login']);
    }

    /**
     * Check if the provided user is authorized for the request.
     *
     * @param array|\ArrayAccess|null $user The user to check the authorization of.
     *   If empty the user fetched from storage will be used.
     * @param \Cake\Network\Request|null $request The request to authenticate for.
     *   If empty, the current request will be used.
     * @return bool True if $user is authorized, otherwise false
     */
    public function isAuthorized($user = null) {
        //TODO add controller action ACL
//        debug($user->hasRole('superadmin'));
//        if (in_array($this->action, array('admin_add', 'admin_index'))) {
//            if ($user['Group']['id'] == 1 || $user['Group']['id'] == 2)
//            {
//                return true;
//            }
//        }
//
//        // The owner of a post can edit and delete it
//        if (in_array($this->action, array('admin_edit', 'admin_delete', 'admin_view', 'admin_disable'))) {
//            $userId = $this->request->params['pass'][0];
//            if ($this->User->isGroupOk($userId, $user['Group']['id'])) {
//                return true;
//            }
//        }
//        $result = parent::isAuthorized($user);
//        if ($result) return true;
//        else {
////            $this->redirect(array('controller' => 'users','action' => 'dashboard', 'language' => Configure::read('Config.language')));
//            return false;
//        }
        return parent::isAuthorized($user);;
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        //TODO show only users with role lower and equal then auth user
        $users = $this->Users->find('all');

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Roles', 'UserActivations']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__d('dejw_cake_standard_auth', 'The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                Log::error('Entity could not be saved. Entity: '.var_export($user, true));
                $this->Flash->error(__d('dejw_cake_standard_auth', 'The user could not be saved. Please, try again.'));
            }
        }
        //TODO show only roles lower or equal than current auth user role
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        //TODO check if editing user with lower or equal role
        $user = $this->Users->get($id, [
            'contain' => ['Roles']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->request->data['password_new'] !== '') {
                $this->request->data('password', $this->request->data['password_new']);
                unset($this->request->data['password_new']);
            }
            $user = $this->Users->patchEntity($user, $this->request->data);
            debug($user);
            if ($this->Users->save($user)) {
                $this->Flash->success(__d('dejw_cake_standard_auth', 'The user has been saved.'));

//                return $this->redirect(['action' => 'index']);
            } else {
                Log::error('Entity could not be saved. Entity: '.var_export($user, true));
                $this->Flash->error(__d('dejw_cake_standard_auth', 'The user could not be saved. Please, try again.'));
            }
        }
        unset($this->request->data['password_new']);
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        //TODO check if deleting user with lower or equal role
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__d('dejw_cake_standard_auth', 'The user has been deleted.'));
        } else {
            $this->Flash->error(__d('dejw_cake_standard_auth', 'The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    //TODO add profile page

    /**
     * Login method
     *
     * @return \Cake\Network\Response|void
     */
    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($this->Users->get($user['id'], [
                    'contain' => ['Roles']
                ]));

                return $this->redirect($this->Auth->redirectUrl());
            }
            Log::error('Login attempt for email: '.$this->request->data('email'));
            $this->Flash->error(__d('dejw_cake_standard_auth', 'Invalid credentials, try again'));
        }

        $this->viewBuilder()->layout('login');
    }

    /**
     * Logout method
     *
     * @return \Cake\Network\Response
     */
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
}
