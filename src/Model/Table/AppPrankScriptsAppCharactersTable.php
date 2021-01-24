<?php
// src/Model/Table/AppPrankScriptsAppCharactersTable.php
namespace App\Model\Table;

use Cake\ORM\Table;

class AppPrankScriptsAppCharactersTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    }
}