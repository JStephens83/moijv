<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class LoanController extends Controller {

    /**
     * @Route("/add/product", name="add_product")
     */
    public function addProduct(ObjectManager $manager, Request $request) {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Vous devez être connecté pour accéder à cette page.');

        $product = new Product(); //On ne met rien dedans car ça sera au user d'entrer les infos, par contre on le met en 2eme paramètre de $form ci-dessous

        $form = $this->createForm(ProductType::class, $product)
                ->add('submit', SubmitType::class);

        $form->handleRequest($request); // A NE PAS OUBLIER

        if ($form->isSubmitted() && $form->isValid()) {
            //on récupère l'image
            $image = $product->getImage();
            $fileName = md5(uniqid()) . '.' . $image->guessExtension();
            $image->move('public/uploads/product', $fileName);
            $product->setImage($fileName, '');
            $product->setUser($this->getUser());

            //S'il est submité et valide, on enregistre le produit
            $manager->persist($product);
            $manager->flush();
        }

        return $this->render('add_product.html.twig', [
                    'form' => $form->createView()
        ]);
    }

    /**
     * @route("/product", name="my_products")
     */
    public function myProducts() {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Vous devez être connecté pour accéder à cette page.');
        
        return $this->render('my_products.html.twig');
    }
    
}
