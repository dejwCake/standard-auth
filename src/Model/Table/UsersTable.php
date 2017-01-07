<?php
namespace DejwCake\StandardAuth\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\HasMany $UserActivations
 * @property \Cake\ORM\Association\BelongsToMany $Roles
 *
 * @method \DejwCake\StandardAuth\Model\Entity\User get($primaryKey, $options = [])
 * @method \DejwCake\StandardAuth\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \DejwCake\StandardAuth\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \DejwCake\StandardAuth\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \DejwCake\StandardAuth\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \DejwCake\StandardAuth\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \DejwCake\StandardAuth\Model\Entity\User findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 * @mixin \Cake\ORM\Behavior\Muffin/Trash.TrashBehavior
 */
class UsersTable extends Table
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

        $this->table('users');
        $this->displayField('email');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Muffin/Trash.Trash');

        $this->hasMany('UserActivations', [
            'foreignKey' => 'user_id',
            'className' => 'DejwCake/StandardAuth.UserActivations'
        ]);
        $this->belongsToMany('Roles', [
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'role_id',
            'joinTable' => 'roles_users',
            'className' => 'DejwCake/StandardAuth.Roles'
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
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');

        $validator
            ->allowEmpty('remember_token');

        $validator
            ->boolean('activated')
            ->requirePresence('activated', 'create')
            ->notEmpty('activated');

        $validator->add('roles', 'custom', [
            'rule' => function($value) {
                return (bool)(is_array($value['_ids']) && count($value['_ids']) > 0);
            },
            'message' => __('Please select at least one item.')
        ]);

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
        //TODO make Custom Rule Objects
        $rules->add(function ($entity, $options) use ($rules) {
            $query = $options['repository']->find('all')
                ->where(['Users.email' =>  $entity->email])
                ->where(['Users.deleted IS' =>  NULL]);
            if(!empty($entity->id)) {
                $query = $query->where(['Users.id !=' =>  $entity->id]);
            }
            if(!$query->first()) {
                return true;
            } else {
                return false;
            }
        },'EmailUnique', [
            'errorField' => 'email',
            'message' => 'This value is not unique'
        ]);

        return $rules;
    }

    /**
     * @param Query $query
     * @param array $options
     * @return Query
     */
    public function findAuth(Query $query, array $options)
    {
        $query
            ->contain(['Roles'])
            ->where(['Users.activated' => 1]);

        return $query;
    }
}
