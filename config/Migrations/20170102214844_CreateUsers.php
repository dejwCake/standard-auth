<?php
use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
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
        $table = $this->table('users');
        $table->addColumn('email', 'string', [
            'limit' => 255,
        ]);
        $table->addColumn('password', 'string', [
            'limit' => 255,
        ]);
        $table->addColumn('remember_token', 'string', [
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('activated', 'boolean', [
            'default' => false,
        ]);
        $table->addColumn('created', 'datetime');
        $table->addColumn('modified', 'datetime', [
            'default' => null,
        ]);
        $table->addColumn('deleted', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addIndex(['email', 'deleted'], [
            'name' => 'USERS_EMAIL_DELETED_UNIQUE',
            'unique' => true,
        ]);
        $table->create();
    }
}
