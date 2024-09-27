<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StarWarsViewController extends AbstractController
{
    /**
     * @Route("/starwars", name="starwars_view")
     */
    public function index()
    {
        return $this->render('starwars/index.html.twig');
    }
}
