<?php 

namespace Controller;

class CategoriesController extends BaseController
{
    public function index()
    {
       return $this->render('categories/index.html.php');
    }
}