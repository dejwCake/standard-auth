<?php
namespace DejwCake\StandardAuth\Controller\Admin;

use Cake\Event\Event;
use Cake\I18n\I18n;
use DejwCake\StandardAuth\Controller\Admin\AppController;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\ConflictException;
use Cake\Routing\Router;

/**
 * Roles Controller
 *
 * @property \DejwCake\StandardAuth\Model\Table\RolesTable $Roles
 */
class RolesController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index', 'view', 'display', 'add']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $roles = $this->paginate($this->Roles);

        $this->set(compact('roles'));
        $this->set('_serialize', ['roles']);
    }

    /**
     * View method
     *
     * @param string|null $id Role id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Roles->locale('en');
        $role = $this->Roles->get($id, [
            'contain' => ['Users']
        ]);
        debug(I18n::locale());
        debug($role);
        $role->translation('sk_sk')->title = 'Otro Título1';
        $role->translation('en_US')->title = 'Un autre Titre1';
        $this->Roles->save($role);
        $role = $this->Roles->get($id, [
            'contain' => ['Users']
        ]);
        debug(I18n::locale());
        debug($role->title);
        debug($role->translation('sk_sk'));

        $this->set('role', $role);
        $this->set('_serialize', ['role']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $role = $this->Roles->newEntity();
        if ($this->request->is('post')) {
            $role = $this->Roles->patchEntity($role, $this->request->data, [
                'translations' => true
            ]);
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                //TODO log errors
                $this->Flash->error(__('The role could not be saved. Please, try again.'));
            }
        }
        $users = $this->Roles->Users->find('list', ['limit' => 200]);
        $this->set(compact('role', 'users'));
        $this->set('_serialize', ['role']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Role id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $role = $this->Roles->get($id, [
            'contain' => ['Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $role = $this->Roles->patchEntity($role, $this->request->data);
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The role could not be saved. Please, try again.'));
            }
        }
        $users = $this->Roles->Users->find('list', ['limit' => 200]);
        $this->set(compact('role', 'users'));
        $this->set('_serialize', ['role']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Role id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $role = $this->Roles->get($id);
        if ($this->Roles->delete($role)) {
            $this->Flash->success(__('The role has been deleted.'));
        } else {
            $this->Flash->error(__('The role could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Enable method
     *
     * @param string|null $id Role id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function enable($id = null)
    {
        $this->request->allowMethod(['post']);
        $role = $this->Roles->get($id);

        if($role->get('enabled') == 1) {
            $role->set('enabled', 0);
        } else {
            $role->set('enabled', 1);
        }

        if ($this->Roles->save($role)) {
            $this->Flash->success(__('The role status has been changed.'));
        } else {
            $this->Flash->error(__('The role status could not be changed. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
