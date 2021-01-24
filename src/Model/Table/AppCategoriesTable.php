<?php
// src/Model/Table/AppCategoriesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;

class AppCategoriesTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');

        $this->belongsToMany('AppPrankScripts', [
            'joinTable' => 'app_prank_scripts_app_categories',
            'foreignKey' => 'app_category_id',
            'targetForeignKey' => 'app_prank_script_id',
        ]);
    }
}