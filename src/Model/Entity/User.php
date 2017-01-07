<?php
namespace DejwCake\StandardAuth\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
use JeremyHarris\LazyLoad\ORM\LazyLoadEntityTrait;

/**
 * User Entity
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property bool $activated
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $deleted
 *
 * @property \DejwCake\StandardAuth\Model\Entity\UserActivation[] $user_activations
 * @property \DejwCake\StandardAuth\Model\Entity\Role[] $roles
 */
class User extends Entity
{
    use LazyLoadEntityTrait;
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    /**
     * Hash password before save
     *
     * @param $password
     * @return bool|string
     */
    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }

    public function hasRole($checkRole) {
        foreach ($this->roles as $role) {
            if($role->name == $checkRole) {
                return true;
            }
        }
        return false;
    }

    public function canEdit($user)
    {
        if(!empty($user['roles'])) {
            $userRoles = [];
            foreach ($user['roles'] as $userRole) {
                $userRoles[] = $userRole['name'];
            }
            $thisRoles = [];
            foreach ($this->roles as $thisRole) {
                $thisRoles[] = $thisRole->get('name');
            }
            if(in_array('superadmin', $userRoles)) {
                return true;
            } else if(in_array('admin', $userRoles) && in_array('superadmin', $thisRoles)) {
                return false;
            } else if(in_array('admin', $userRoles) && in_array('admin', $thisRoles)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
