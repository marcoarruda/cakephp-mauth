<?php

namespace MAuth\Model\Entity;

use Cake\ORM\Entity;

class Group extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
