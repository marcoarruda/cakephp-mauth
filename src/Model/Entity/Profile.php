<?php

namespace MAuth\Model\Entity;

use Cake\ORM\Entity;

/**
 * AuthUser Entity.
 *
 * @property int $id
 * @property int $group_id
 * @property \App\Model\Entity\Group $group
 * @property string $email
 * @property string $password
 * @property bool $active
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Profile extends Entity {

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
    'id' => false,
  ];

  protected function _getFullName() {
    if (isset($this->_properties['full_name'])) {
      return $this->_properties['full_name'];
    }
    return $this->_properties['first_name'] . ' ' . $this->_properties['last_name'];
  }

}
