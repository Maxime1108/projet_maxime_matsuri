<?php 

namespace Controller\Admin;

use Controller\BaseController;

class HomeController extends BaseController
{
    public function index(){
        return $this->render('admin/home.html.php');
    }
}