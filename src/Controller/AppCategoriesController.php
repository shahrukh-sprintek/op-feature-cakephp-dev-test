<?php
// src/Controller/AppCategoriesController.php

namespace App\Controller;

use Rest\Controller\RestController;
use Cake\ORM\TableRegistry;

class AppCategoriesController extends RestController
{
    public $paginate = [
        'limit' => 10
    ];

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }

    public function getCategories()
    {
        $recordLimit = $this->request->params['limitPerPage'];
        $pageNumber = $this->request->params['page'];
        
        
        $appCategoriesTable = TableRegistry::get('AppCategories');
        $categories = $appCategoriesTable->find();
        $count = $categories->count();
        
        $totalPages = ceil($count/$recordLimit);
        // dump($totalPages);
        
        $categories = $categories->limit($recordLimit)->page($pageNumber);
        
        // $categories->selectAllExcept($appCategoriesTable, ['slug']);
        // $this->paginate['limit'] = 3;
        // $this->set('app_cats', $this->paginate($categories));
        
        foreach($categories as $category){
            
        }

        $this->set(compact(['totalPages', 'count', 'categories']));
    }

    public function getPrankCategories()
    {
        $appCategoriesTable = TableRegistry::get('AppCategories');
        $categories = $appCategoriesTable->find()->contain(['AppPrankScripts']);
        $count = $categories->count();
        
        // $totalPages = ceil($count/$recordLimit);
        // dump($totalPages);
        
        // $categories = $categories->limit($recordLimit)->page($pageNumber);
        
        foreach($categories as $category){
        }

        $this->set(compact(['categories']));
    }

    public function getCategoryPranksBySlug()
    {
        $slug = $this->request->params['slug'];
        $appCategoriesTable = TableRegistry::get('AppCategories');
        $categories = $appCategoriesTable->find()
        ->where(['AppCategories.slug ' => $slug])
        ->contain(['AppPrankScripts']);
        
        $count = $categories->count();
        
        // $totalPages = ceil($count/$recordLimit);
        // dump($totalPages);
        
        // $categories = $categories->limit($recordLimit)->page($pageNumber);
        
        foreach($categories as $category){
        }

        $this->set(compact(['categories']));
    }
}