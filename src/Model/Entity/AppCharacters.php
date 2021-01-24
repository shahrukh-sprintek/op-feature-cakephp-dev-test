<?php
// src/Model/Entity/AppCharacters.php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class AppCharacters extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'slug' => false,
    ];
}