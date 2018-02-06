<?php

//Ce fichier a été crée dans Controller (avec php bin/console make:controller UserController dans la cmd) et on l'a bougé dans Admin, on a donc changé le chemin ci-dessous
namespace App\Controller\Admin;

use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
        //Ci dessous on modifie aussi le nom de la route car on a déplacé le fichier dans Amdin. on modifie aussi le "name".
    /**
     * @Route("admin/user", name="list_user")
     */
    // On modifie le nom de la méthode pour refléter ce que l'on veut faire (ici, récupérer la liste des users)
    public function getList(UserRepository $userRepo)// vaut: (App\Repository\UserRepository $userRepo) -> cf. cours.txt sur les injections de dépendances
    {
        // Notre repository est injecté en paramètres de l'action (la méthode) de notre controller. $userRepo contient donc une instance (un objet) prète à l'emploi de Class UserRepository.
        //Cet objet nous sert à récupérer notre liste de users.
        $users = $userRepo->findAll();
        return $this->render('admin/list_user.html.twig',[
                'users' => $users
            ]);
    }
    /**
     * @Route("/admin/user/{id}")
     */
    public function details(UserRepository $userRepo, $id) {
        //On récupère le user 
        $user= $userRepo->find($id);
        //on l'insère dans le template(view)
        return $this->render('admin/details_user.html.twig', [
            'user' => $user
        ]);
    }
}
