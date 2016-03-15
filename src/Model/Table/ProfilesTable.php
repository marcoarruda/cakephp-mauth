<?php

namespace MAuth\Model\Table;

use App\Model\Entity\AuthUser;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ProfilesTable extends Table {

  public function initialize(array $config) {
    parent::initialize($config);

    $this->table('auth_profiles');
    $this->displayField('id');
    $this->primaryKey('id');

    $this->addBehavior('Timestamp');

    $this->belongsTo('Users', [
      'className' => 'MAuth.Users',
      'foreignKey' => 'user_id',
      'joinType' => 'INNER'
    ]);

    $this->addBehavior('Josegonzalez/Upload.Upload', [
      'image' => [
        'path' => 'uploads{DS}{model}{DS}{field}{DS}{time}{DS}',
        'fields' => ['dir' => 'image_dir'],
        'filesystem' => ['root' => ROOT . DS . 'webroot' . DS]
      ]
    ]);
  }
  public function validationDefault(Validator $validator) {
    $validator
      ->add('id', 'valid', ['rule' => 'numeric'])
      ->allowEmpty('id', 'create');

    $validator
      ->allowEmpty('image');

    $validator
      ->allowEmpty('image_dir');

    return $validator;
  }
  public function buildRules(RulesChecker $rules) {
    return $rules;
  }

}
