<?php
use Cake\ORM\TableRegistry;
use Migrations\AbstractMigration;

class AddRoles extends AbstractMigration
{
    protected $data;

    protected function setData()
    {
        $this->data = [
            [
                'name' => 'SuperAdmin',
                'enabled' => 1,
            ],
            [
                'name' => 'Admin',
                'enabled' => 1,
            ],
            [
                'name' => 'User',
                'enabled' => 1,
            ],
        ];
    }

    public function up() {
        $this->setData();
        // Save records to the newly created schema
        $RolesTable = TableRegistry::get('Roles');
        foreach ($this->data as $roleData) {
            $role = $RolesTable->newEntity($roleData);
            $RolesTable->save($role);
        }
    }

    public function down() {
        //TODO delete items
    }
}
