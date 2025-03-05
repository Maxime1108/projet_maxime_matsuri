<?php

namespace Controller;

use Controller\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        // Ici on crée le tableau qui affichera les différentes catégories (ça libère la place dans la vue)
        $categories = [
            ["title" => "Jeux Videos", "image" => "public/assets/img/animalcrossing.avif", "link" => "views/jeux_videos/jeux_video_page.html.php"],
            ["title" => "Mangas", "image" => "public/assets/img/tenki no ko.jpg", "link" => "views/mangas/manga_page.html.php"],
            ["title" => "Accessoires", "image" => "public/assets/img/toriiphoto (1).jpg", "link" => "views/accessoires/accessoires_page.html.php"],
            ["title" => "Vêtements Traditionnels", "image" => "public/assets/img/yukata.jpg", "link" => "views/vetements_traditionnels/vetements_traditionnels.html.php"]
        ];

        return $this->render('home/index.html.php', [
            'categories' => $categories
        ]);
    }

    public function a_propos()
    {
        return $this->render('home/a_propos.html.php');
    }
}
