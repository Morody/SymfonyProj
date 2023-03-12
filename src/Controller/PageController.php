<?php

namespace App\Controller;
use App\Entity\Page;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class PageController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(EntityManagerInterface $entityManager, UserInterface $user): Response
    {
        $homePage = $entityManager->getRepository(Page::class)->find(1);

        return $this->render('page/index.html.twig', ['user'=>$user]);
    }
}
