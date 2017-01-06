<?php
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use DejwCake\StandardAuth\Model\Entity\Role;
use Migrations\AbstractMigration;

class AddRoles extends AbstractMigration
{
    protected $data;

    protected function setData()
    {
        $this->data = [
            [
//                '_translations.sk.title' => 'SuperAdmin',
//                '_translations.en.title' => 'SuperAdmin',
                'title' => 'SuperAdmin',
                'name' => 'superadmin',
                'enabled' => 1,
            ],
            [
//                '_translations.sk.title' => 'Admin',
//                '_translations.en.title' => 'Admin',
                'title' => 'Admin',
                'name' => 'admin',
                'enabled' => 1,
            ],
            [
//                '_translations.sk.title' => 'User',
//                '_translations.en.title' => 'User',
                'title' => 'User',
                'name' => 'user',
                'enabled' => 1,
            ],
        ];
    }

    public function up() {
        $this->setData();
        // Save records to the newly created schema
        $rolesTable = TableRegistry::get('Roles');
        foreach ($this->data as $roleData) {
//            $role = $rolesTable->newEntity($roleData, [
//                'translations' => true
//            ]);
            $role = new Role($roleData);
            $rolesTable->save($role);

            $role->_locale = 'sk';
            $role->title = 'Mi primer Artículo';

            $rolesTable->save($role);
//            echo $role->translation('sk')->title;
//            echo $role->translation('en')->title;

//            foreach (Configure::read('App.supportedLocales') as $locale => $title) {
//                $role->translation($locale)->set($roleData, ['guard' => false]);
//            }
//            debug($role);
//            die;

//            $rolesTable->save($role);
        }
    }

    public function down() {
        //TODO delete items
    }
}
