<?php

namespace MAuth\Model\Table;

use App\Model\Entity\AuthUser;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;

class UsersTable extends Table {

  public function initialize(array $config) {
    parent::initialize($config);

    $this->table('auth_users');
    $this->displayField('email');
    $this->primaryKey('id');

    $this->addBehavior('Timestamp');

    $this->belongsTo('Groups', [
      'className' => 'MAuth.Groups',
      'foreignKey' => 'group_id',
      'joinType' => 'INNER'
    ]);

    $this->hasOne('Profiles', [
      'className' => 'MAuth.Profiles',
      'foreignKey' => 'user_id',
      'joinType' => 'INNER'
    ]);
  }
  public function validationDefault(Validator $validator) {
    $validator
      ->add('id', 'valid', ['rule' => 'numeric'])
      ->allowEmpty('id', 'create');

    $validator
      ->add('email', 'valid', ['rule' => 'email'])
      ->requirePresence('email', 'create')
      ->notEmpty('email');

    $validator
      ->requirePresence('password', 'create')
      ->notEmpty('password');

    $validator
      ->add('active', 'valid', ['rule' => 'boolean'])
      ->requirePresence('active', 'create')
      ->notEmpty('active');

    return $validator;
  }
  public function validationPassword(Validator $validator) {
    $validator
      ->add('old_password', 'custom', [
        'rule' => function($value, $context) {
          $user = $this->get($context['data']['id']);
          if ($user) {
            if ((new DefaultPasswordHasher)->check($value, $user->password)) {
              return true;
            }
          }
          return false;
        },
        'message' => 'The old password does not match the current password!',
      ])
      ->notEmpty('old_password');

    $validator
      ->add('new_password', [
        'length' => [
          'rule' => ['minLength', 6],
          'message' => 'The password have to be at least 6 characters!',
        ]
      ])
      ->add('new_password', [
        'match' => [
          'rule' => ['compareWith', 'new_password_confirm'],
          'message' => 'The passwords does not match!',
        ]
      ])
      ->notEmpty('new_password');
    $validator
      ->add('new_password_confirm', [
        'length' => [
          'rule' => ['minLength', 6],
          'message' => 'The password have to be at least 6 characters!',
        ]
      ])
      ->add('new_password_confirm', [
        'match' => [
          'rule' => ['compareWith', 'new_password_confirm'],
          'message' => 'The passwords does not match!',
        ]
      ])
      ->notEmpty('new_password_confirm');

    return $validator;
  }
  public function buildRules(RulesChecker $rules) {
    $rules->add($rules->isUnique(['email']));
    $rules->add($rules->existsIn(['group_id'], 'Groups'));
    return $rules;
  }

}
