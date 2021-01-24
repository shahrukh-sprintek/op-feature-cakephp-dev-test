<?php
// src/Model/Table/AppCharactersTable.php
namespace App\Model\Table;

use Cake\ORM\Table;

class AppCharactersTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    }
}