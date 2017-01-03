<?php
use Migrations\AbstractMigration;

class CreateRoles extends AbstractMigration
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
        $table = $this->table('roles');
        $table->addColumn('name', 'string', [
            'limit' => 255,
        ])->addIndex(['name'], [
            'name' => 'ROLES_NAME_UNIQUE',
            'unique' => true,
        ]);
        $table->addColumn('enabled', 'boolean', [
            'default' => true,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('deleted', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();

        $table = $this->table('role_i18ns');
        $table->addColumn('locale', 'string', [
            'default' => null,
            'limit' => 6,
            'null' => false,
        ]);
        $table->addColumn('model', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('foreign_key', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('field', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('content', 'text', [
            'default' => null,
            'null' => false,
        ]);

        $table->addIndex(['locale',], [
            'name' => 'locale',
            'unique' => false,
        ]);
        $table->addIndex(['model',], [
            'name' => 'model',
            'unique' => false,
        ]);
        $table->addIndex(['foreign_key',], [
            'name' => 'row_id',
            'unique' => false,
        ]);
        $table->addIndex(['field',], [
            'name' => 'field',
            'unique' => false,
        ]);
        $table->addIndex(['locale', 'model', 'foreign_key', 'field',], [
            'name' => 'I18N_LOCALE_FIELD',
            'unique' => true,
        ]);
        $table->addIndex(['model', 'foreign_key', 'field',], [
            'name' => 'I18N_FIELD',
            'unique' => false,
        ]);
        $table->create();
    }
}
