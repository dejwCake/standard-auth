<?php
namespace DejwCake\StandardAuth\Model\Table;

use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Roles Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Users
 *
 * @method \DejwCake\StandardAuth\Model\Entity\Role get($primaryKey, $options = [])
 * @method \DejwCake\StandardAuth\Model\Entity\Role newEntity($data = null, array $options = [])
 * @method \DejwCake\StandardAuth\Model\Entity\Role[] newEntities(array $data, array $options = [])
 * @method \DejwCake\StandardAuth\Model\Entity\Role|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \DejwCake\StandardAuth\Model\Entity\Role patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \DejwCake\StandardAuth\Model\Entity\Role[] patchEntities($entities, array $data, array $options = [])
 * @method \DejwCake\StandardAuth\Model\Entity\Role findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\Muffin/Trash.TrashBehavior
 * @mixin \Cake\ORM\Behavior\TranslateBehavior
 */
class RolesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('roles');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Muffin/Trash.Trash');
        $this->addBehavior('Translate', [
            'fields' => ['title'],
            'translationTable' => 'RolesI18n'
//            'validator' => 'translated',
        ]);

        $this->belongsToMany('Users', [
            'foreignKey' => 'role_id',
            'targetForeignKey' => 'user_id',
            'joinTable' => 'roles_users',
            'className' => 'DejwCake/StandardAuth.Users'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $translationValidator = new Validator();
        $translationValidator
            ->requirePresence('title', 'create')
            ->allowEmpty('title');

        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->addNestedMany('_translations', $translationValidator)
            ->requirePresence('_translations', 'false')
            ->allowEmpty('_translations');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['name']));

        return $rules;
    }

    /**
     * @param Query $query
     * @param array $options
     * @return Query
     */
    public function findForUser(Query $query, array $options)
    {
        $query = $query
            ->select(['id', 'title']);

        $user = $options['user'];
        if(!empty($user['roles'])) {
            $userRoles = [];
            foreach ($user['roles'] as $userRole) {
                $userRoles[] = $userRole['name'];
            }
            if(in_array('superadmin', $userRoles)) {

            } else if(in_array('admin', $userRoles)) {
                $query = $query->where(['Roles.name NOT LIKE' => 'superadmin']);
            } else {
                $query = $query->where(['1' => '0']);
            }
        }
        return $query->find('list', [
            'limit' => 200,
            'keyField' => 'id',
            'valueField' => 'title'
        ]);
    }
}
