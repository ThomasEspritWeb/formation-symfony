<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    // / qui va lister l'ensemble de nos articles
    /**
     * @Route("/", name="liste_articles", methods={"GET"})
     */
    public function listeArticles():Response{

        $url1 = $this->generateUrl('vue_article', ['id' => 1]);
        $url2 = $this->generateUrl('vue_article', ['id' => 2]);
        $url3 = $this->generateUrl('vue_article', ['id' => 3]);

        return new Response("<ul>
                                <li><a href='".$url1."'>Article 1</a></li>
                                <li><a href='".$url2."'>Article 2</a></li>
                                <li><a href='".$url3."'>Article 3</a></li>
                            </ul>");
    }


    // /12 afficher un article
    /**
     * @Route("/{id}", name="vue_article", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function vueArticle($id){
        return new Response("<h1>Article ".$id."</h1> <p>Ceci est le contenu de l'article</p>");
    }
}
