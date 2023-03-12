<?php

namespace App\Controller;

use App\Entity\DescriptionVideo;
use App\Entity\Video;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class DescriptionController extends AbstractController
{

    #[Route('/description_add', name: 'description_add')]
    public function index(EntityManagerInterface $entityManager, UserInterface $user, Request $request): Response
    {
        $comment = $request->get('comment');
            $desc = new DescriptionVideo($comment, $_SESSION['Video'], $user);
            $entityManager->merge($desc);
            $entityManager->flush();
            return new Response('Ok');
    }
}
