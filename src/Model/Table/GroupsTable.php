<?php

namespace MAuth\Model\Table;

use App\Model\Entity\AuthUser;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class GroupsTable extends Table
{

  public function initialize(array $config)
  {
    parent::initialize($config);

    $this->table('auth_groups');
    $this->displayField('id');
    $this->primaryKey('id');

    $this->addBehavior('Timestamp');

    $this->hasMany('Users', [
      'className' => 'MAuth.Users',
      'foreignKey' => 'group_id',
      'joinType' => 'INNER'
    ]);
  }

  public function validationDefault(Validator $validator)
  {
    $validator
      ->add('id', 'valid', ['rule' => 'numeric'])
      ->allowEmpty('id', 'create');

    return $validator;
  }

  public function buildRules(RulesChecker $rules)
  {
    return $rules;
  }
}
