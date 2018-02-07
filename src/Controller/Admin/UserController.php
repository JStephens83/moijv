<?php

//Ce fichier a été crée dans Controller (avec php bin/console make:controller UserController dans la cmd) et on l'a bougé dans Admin, on a donc changé le chemin ci-dessous
namespace App\Controller\Admin;

use App\Entity\User;
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
//user repository = lien entre BDD et le controller
    {
        // Notre repository est injecté en paramètres de l'action (la méthode) de notre controller. $userRepo contient donc une instance (un objet) prète à l'emploi de Class UserRepository.
        //Cet objet nous sert à récupérer notre liste de users, à les stocker puis à les afficher et à les injecter dans notre vue list_user.html.twig.
        $users = $userRepo->findAll();
        return $this->render('admin/list_user.html.twig',[
                'users' => $users
            ]);
    }
    //{id}: car peut varier
    
    
    
    /**
     * @Route("/admin/user/{id}", name="user_details")
     */
    public function details(User $user) {
        //on l'insère dans le template(view)
        return $this->render('admin/details_user.html.twig', [
            'user' => $user
        ]);
        
        //public function details(User $user) {
        //return $this->render('admin/details_user.html.twig', [
        //  'user' => $user
        //]); 
        //VAUT CI-DESSOUS:
        //public function details(UserRepository $userRepo, $id) {
        //$user= $userRepo->find($id);
        //return $this->render('admin/details_user.html.twig', [
        //   'user' => $user
        //]);
    }
}
