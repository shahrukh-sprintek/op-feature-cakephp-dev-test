<?php
// src/Model/Entity/AppCategories.php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class AppCategories extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'slug' => false,
    ];
}