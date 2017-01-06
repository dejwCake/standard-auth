<?php

namespace DejwCake\StandardAuth\Controller\Admin;

use App\Controller\AppController as BaseController;
use Cake\Core\Configure;
use Cake\Event\Event;

class AppController extends BaseController
{
    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        $this->viewBuilder()->theme('DejwCake/AdminLTE');
        $this->set('theme', Configure::read('Theme'));
    }
}
