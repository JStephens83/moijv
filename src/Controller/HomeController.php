<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller 
{
    // Ci-dessous on dit à Symfony quelle route suivre.
    // @Route correspond à une classe dans Symfony
    /**
     * @Route("/")
     * @Route("/home")
     */
    // Création d'une méthode pour ouvrir une page.
    public function home(){
        return $this->render('Home.html.twig');
    }
  
    // creation d'une autre route pour accéder à la page profile (par exemple)
    /**
     *@Route("/profile")
     */  
    /*
    public function profile(){
        return $this->render('profile.html.twig');
    } 
    */
    
    //creation d'une table user grâce à Symphony
    
}