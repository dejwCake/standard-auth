<?php

namespace DejwCake\StandardAuth\Controller\Admin;

use App\Controller\AppController as BaseController;
use Cake\Core\Configure;
use Cake\Event\Event;

class AppController extends BaseController
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
//        $this->Auth->allow([]);
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        $this->viewBuilder()->theme('DejwCake/AdminLTE');
        $this->set('theme', Configure::read('Theme'));
    }
}
