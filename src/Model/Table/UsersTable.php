<?php

namespace MAuth\Model\Table;

use App\Model\Entity\AuthUser;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

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
  
  public function buildRules(RulesChecker $rules) {
    $rules->add($rules->isUnique(['email']));
    $rules->add($rules->existsIn(['group_id'], 'Groups'));
    return $rules;
  }

}
