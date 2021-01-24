<?php
// src/Model/Entity/AppPrankScripts.php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class AppPrankScripts extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'slug' => false,
    ];
}