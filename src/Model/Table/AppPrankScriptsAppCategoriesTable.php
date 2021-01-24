<?php
// src/Model/Table/AppPrankScriptsAppCategoriesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;

class AppPrankScriptsAppCategoriesTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    }
}