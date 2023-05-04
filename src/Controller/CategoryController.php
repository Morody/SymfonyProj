<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Video;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'category')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $categories = $entityManager->getRepository(Category::class)->findAll();
        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/add_category', name: "add_category")]
    public function addCategory(EntityManagerInterface $entityManager): Response
    {
//        $category = $entityManager->getRepository(Category::class)->findBy(['title'=>'Sport']);
//        $video = $entityManager->getRepository(Video::class)->findBy(['youtube_id' => 'fp5-XQFr_nk']);
//        $video[0]->setCategoryId(1);
//        var_dump($video[0]);
        if (isset($_POST['category'])){
            $category = $entityManager->getRepository(Category::class)->findBy(['title'=>$_POST['category']]);
            if (empty($category)){
                $category = new Category($_POST['category']);
                $entityManager->persist($category);
                $entityManager->flush();
            }

            $category = $entityManager->getRepository(Category::class)->findBy(['title'=>$_POST['category']]);
            $video = $entityManager->getRepository(Video::class)->findBy(['youtube_id' => $_SESSION['Video']->youtube_id]);

            $video[0]->setCategoryId($category[0]->getId());

            $entityManager->persist($video[0]);
            $entityManager->flush();

            $categories = $entityManager->getRepository(Category::class)->findAll();

            return $this->render('category/index.html.twig', [
                'categories' => $categories,
            ]);
        }

        return $this->render('category/add_category.html.twig', []);
    }

}
