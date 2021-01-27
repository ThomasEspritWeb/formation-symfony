<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CommentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $prenoms = [
            'Isabelle',
            'Paul',
            'Victor',
            'Bernard',
            'Sandra',
            'Vanessa'
        ];

        $comments = [
            "Nullam nec tortor bibendum, tempor est vitae, dignissim nulla. Phasellus sollicitudin nunc sed fermentum condimentum. Etiam ac condimentum purus",
            "Quisque dignissim ex a vulputate pellentesque. Etiam vestibulum nec felis vel commodo. Sed sed tellus ut erat porta varius ut rutrum eros",
            "Proin congue, urna eget aliquam sodales, odio nisi tempus sapien, eget congue eros tellus sit amet sem. Integer viverra ex ac elit accumsan",
            "Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin facilisis mattis maximus",
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam bibendum nunc at aliquet pulvinar. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus"
        ];

        for($i = 1; $i <= 50; $i++){
            $comment = new Comment();
            $comment->setContenu($comments[array_rand($comments)]);
            $comment->setAuthor($prenoms[array_rand($prenoms)]);
            $comment->setDateComment(new \DateTime('-'.random_int(1, 45).' days'));
            $comment->setArticle($this->getReference('article-'.random_int(1, 25)));

            $manager->persist($comment);
        }




        $manager->flush();
    }

    public function getDependencies(){
        return [
            ArticleFixtures::class
        ];
    }
}
