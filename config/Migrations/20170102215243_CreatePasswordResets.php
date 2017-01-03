<?php
use Migrations\AbstractMigration;

class CreatePasswordResets extends AbstractMigration
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
        $table = $this->table('password_resets');
        $table->addColumn('email', 'string', [
            'limit' => 255,
            'null' => false,
        ])->addIndex(['email']);
        $table->addColumn('token', 'string', [
            'limit' => 255,
            'null' => false,
        ])->addIndex(['token']);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }
}
