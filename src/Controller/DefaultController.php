<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Form\ArticleType;
use App\Form\CommentType;
use App\Repository\ArticleRepository;
use App\Service\VerificationComment;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    // / qui va lister l'ensemble de nos articles
    /**
     * @Route("/", name="liste_articles", methods={"GET"})
     */
    public function listeArticles(ArticleRepository $articleRepository):Response{

        $articles = $articleRepository->findBy([
            'state' => 'publie'
        ]);

        return $this->render('default/index.html.twig', [
            'articles' => $articles,
            'brouillon' => false
        ]);
    }


    // /12 afficher un article
    /**
     * @Route("/{id}", name="vue_article", requirements={"id"="\d+"}, methods={"GET", "POST"})
     */
    public function vueArticle(Article $article, Request $request, EntityManagerInterface $manager, VerificationComment $verifService, FlashBagInterface $session){

        $comment = new Comment();
        $comment->setArticle($article);

        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            if($verifService->commentaireNonAutorise($comment) === false){
                $manager->persist($comment);
                $manager->flush();

                return $this->redirectToRoute('vue_article',  ['id' => $article->getId()]);
            }
            else{
                $session->add("danger", "Le commentaire contient un mot interdit");
            }

        }

        return $this->render('default/vue.html.twig', [
            'article' => $article,
            'form' => $form->createView()
        ]);
    }
}
