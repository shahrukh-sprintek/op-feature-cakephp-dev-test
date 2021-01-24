<?php
// src/Model/Table/AppPrankScriptsTable.php
namespace App\Model\Table;

use Cake\ORM\Table;

class AppPrankScriptsTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    }
}