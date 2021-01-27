<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $state = ['brouillon', 'publie'];

        for($i = 1; $i <= 25;$i++){
            $article = new Article();
            $article->setTitre("Article n°".$i);
            $article->setContenu("dis parturient montes, nascetur ridiculus mus. Integer mollis justo in pharetra pulvinar. Mauris quam sem, bibendum sed tincidunt sed, posuere tempor felis. Maecenas sed tempor magna. Nunc molestie maximus eleifend. Phasellus dictum nulla blandit ligula facilisis, a pretium nisi maximus. Morbi ullamcorper a nisi eu tincidunt. Ut in urna elit. Nulla condimentum sodales posuere.
                                Suspendisse vel consequat orci. Nullam nec tortor bibendum, tempor est vitae, dignissim nulla. Phasellus sollicitudin nunc sed fermentum condimentum. Etiam ac condimentum purus, non fermentum neque. Duis nec ultricies lectus. Vestibulum lobortis mollis dolor sed dictum. Nunc id iaculis nibh, tristique ullamcorper nisi. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque dui magna, porttitor eu tempus id, commodo vel quam. Ut elementum orci sollicitudin neque lobortis facilisis.
                                Duis sagittis tortor tincidunt porttitor dapibus. Quisque dignissim ex a vulputate pellentesque. Etiam vestibulum nec felis vel commodo. Sed sed tellus ut erat porta varius ut rutrum eros. Proin congue, urna eget aliquam sodales, odio nisi tempus sapien, eget congue eros tellus sit amet sem. Integer viverra ex ac elit accumsan, sed lacinia ante semper. Ut gravida justo eu eros fermentum ultricies non et nulla. Nam suscipit tempus est, ut vehicula sapien sollicitudin sed. Mauris ut mattis nisi.
                                Integer malesuada dignissim arcu eget sagittis. Cras pellentesque leo ac urna tincidunt, id pulvinar turpis iaculis. Praesent faucibus odio odio, vel congue mauris venenatis eget. Praesent tincidunt, magna in rutrum pharetra, lorem diam maximus metus, in viverra nisl arcu nec nunc. Aliquam at lacus nibh. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin facilisis mattis maximus.
                                Donec at venenatis neque, ut fermentum nisi. Nullam laoreet ultricies dui, eu commodo velit sollicitudin sit amet. Aenean vel consequat ex. Aenean vel maximus ante. Mauris varius cursus leo. Mauris quis facilisis odio. Vestibulum diam tortor, lacinia sit amet molestie id, finibus eget risus. Donec maximus leo est, sed scelerisque lectus consequat in. Praesent arcu est, eleifend vitae libero sed, auctor porta augue. Proin quis purus sapien. Integer eu ligula nec sem pellentesque lobortis. Nulla rutrum porttitor felis, ut viverra nulla dictum a. Quisque luctus a ligula sit amet porta. Ut metus ante, pharetra non dolor ac, sollicitudin luctus mi.");
            $article->setState($state[array_rand($state)]);

            $date = new \DateTime();
            $date->modify('-'.$i.' days');

            $article->setDateCreation($date);

            $this->addReference('article-'.$i, $article);

            $manager->persist($article);
        }



        $manager->flush();
    }
}
