<?php
use Migrations\AbstractMigration;

class CreateUserActiations extends AbstractMigration
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
        $table = $this->table('user_activations');
        $table->addColumn('user_id', 'integer')
            ->addForeignKey('user_id', 'users', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'])
            ->addIndex(['user_id',]);
        $table->addColumn('token', 'string', [
            'limit' => 255,
        ])->addIndex(['token'], [
            'name' => 'USER_ACTIVATIONS_TOKEN_UNIQUE',
            'unique' => true,
        ]);
        $table->addColumn('activated', 'boolean', [
            'default' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }
}
