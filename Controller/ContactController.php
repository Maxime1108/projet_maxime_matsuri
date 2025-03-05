<?php

namespace Controller;

class ContactController extends BaseController
{
    public function index()
    {
       return $this->render('contact/contact.html.php');
    }

    public function contact()
    {

    }
}