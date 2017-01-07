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
        $this->Auth->allow([]);
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

    protected function editTranslated($object)
    {
        //TODO move to better place
        list($plugin, $class) = pluginSplit($this->modelClass, true);
        if($this->{$class}->behaviors()->has('Translate')) {
            foreach ($this->{$class}->behaviors()->get('Translate')->config('fields') as $field) {
                $object->translation(Configure::read('App.defaultLocale'))->{$field} = $object->{$field};
            }
        }
        return $object;
    }
}
