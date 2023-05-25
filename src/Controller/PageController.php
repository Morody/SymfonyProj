<?php

namespace App\Controller;
use App\Entity\DescriptionVideo;
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
        $desc = new DescriptionVideo('gsdf','Xg8Z-99CIHQ', $user);
        $entityManager->detach($desc);

        return $this->render('page/index.html.twig', ['user'=>$user]);
    }
}
