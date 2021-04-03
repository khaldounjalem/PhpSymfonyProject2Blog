<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Monofony\Plugin\FixturesPlugin\Fixture\Factory\AbstractExampleFactory;


class ArticleFixtures extends Fixture
{
    
    #$faker = Factory::create("fr_FR");
    
    public function load(ObjectManager $manager)
    {

        for ($i=1; $i <5 ; $i++) { 
            $category = new Category();
            $category->setTitle("المجال $i");
            $category->setDescription("وصف المجال $i");

            $manager->persist($category);

            for ($j=1; $j <=2 ; $j++) { 
                $article = new Article();
                $article->setTitle("Adress $j")
                        ->setContent("Lorem Ipsum is simply dummy text of the printing
                         and typesetting industry. Lorem Ipsum has been the industry's
                          standard dummy text ever since the 1500s, when an unknown 
                        ")
                        ->setCreatedAt(new \DateTime())
                        #->setCreatedAt($faker->dateTimeBetween('-6 month'))
                        ->setUpdatedAt(new \DateTime())
                        ->setImage("https://picsum.photos/id/1025/400/200")
                        ->setCategory($category);
  
                        $manager->persist($article);
                $today = new DateTime();
                $difference = $today->diff($article->getCreatedAt());

                $days = $difference->days;
                $comment_maximum = '-'.$days. 'days';
                        for ($k=0; $k <= mt_rand(4,6); $k++){
                            $comment = new Comment();
                            $comment->setAuthor("sara")
                                    ->setContent("and typesetting industry. Lorem Ipsum has been the industry's
                                    standard dummy text ever since the 1500s, when")
                                    ->setCreatedAt(new \DateTime())
                                    // $comment->setAuthor($faker->name)
                            //     ->setContent("dummy text ever since the 1500s, when an unknown 
                            //     printer took a galley of type and scrambled it to make a 
                            //     type specimen by five centuries, 
                            //     but also the leap into electronic typesetting,");
                            //     ->setCreatedAt($faker->dateTimeBetween($comment_maximum));
                                ->setArticle($article);
                            $manager->persist($comment);
                        }
            }
        }

        $manager->flush();
    }
}
