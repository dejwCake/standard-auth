<?php
use Migrations\AbstractMigration;

class CreateRolesUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('roles_users');
        $table->addColumn('user_id', 'integer')
            ->addForeignKey('user_id', 'users', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'])
            ->addIndex(['user_id',]);
        $table->addColumn('role_id', 'integer')
            ->addForeignKey('role_id', 'roles', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'])
            ->addIndex(['role_id',]);
        $table->create();
    }
}
