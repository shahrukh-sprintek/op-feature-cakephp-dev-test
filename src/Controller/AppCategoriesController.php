<?php
// src/Controller/AppCategoriesController.php

namespace App\Controller;

use Rest\Controller\RestController;
use Cake\ORM\TableRegistry;
use Cake\ORM\Query;

class AppCategoriesController extends RestController
{
    public $paginate = [
        'limit' => 10
    ];

    public $prankSlug=null;
    public $prankScripts=null;
    public $recordsPerPage=null;
    public $pageNumber=null;

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

    //get category by slug with pranks as well
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

    //get pranks by slug in particular category(also found by slug)
    public function getPranksBySlug()
    {
        $categorySlug = $this->request->params['categorySlug'];
        $prankSlug = $this->request->params['prankSlug'];
        $this->prankSlug = '%'.$prankSlug.'%';
        $this->recordsPerPage = $this->request->params['recordsPerPage'];
        $this->pageNumber = $this->request->params['pageNumber'];

        //temp count for total pranks in found table
        $appCategoriesTable = TableRegistry::get('AppCategories');
        $categories = $appCategoriesTable->find()
        ->where(['AppCategories.slug ' => $categorySlug])
        ->contain('AppPrankScripts' , function (Query $q) {
            $q
            ->where(['AppPrankScripts.title LIKE' => $this->prankSlug]);
            return $q;
        }
        );
        
        $pranks = array();
        
        foreach($categories as $category){
            $pranks = $category->app_prank_scripts;
        }
        
        $count = count($pranks);
        $totalPages = ceil($count/$this->recordsPerPage);
        //end temp count for total pranks in found table

        $appCategoriesTable = TableRegistry::get('AppCategories');
        $categories = $appCategoriesTable->find()
        ->where(['AppCategories.slug ' => $categorySlug])
        ->contain('AppPrankScripts' , function (Query $q) {
            $q
            ->where(['AppPrankScripts.title LIKE' => $this->prankSlug]);
            $q->limit($this->recordsPerPage)->page($this->pageNumber);
            return $q;
        }
        );
        
        $pranks = array();
        
        foreach($categories as $category){
            $pranks = $category->app_prank_scripts;
        }

        $this->set(compact(['totalPages', 'count', 'pranks']));
    }
}