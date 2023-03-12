<?php

namespace App\Controller;

use App\Entity\DescriptionVideo;
use App\Entity\User;
use App\Entity\Video;
use App\Services\GetCommentService;
use App\Services\UrlService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class VideoController extends AbstractController
{

    #[Route('/video', name: 'video')]
    public function index(EntityManagerInterface $entityManager, UserInterface $user): Response
    {

        $videos = $entityManager->getRepository(Video::class)->findAllWithCategories($user->getId());
        return $this->render('video/index.html.twig', [
            'videos' => $videos,
        ]);
    }

    #[Route('/add_video', name: 'add_video')]
    public function addVideo():Response
    {
        return $this->render('video/add_video.html.twig');
    }

    #[Route('/video/{youtube_id}', name: 'show_video')]
    public function showOneVideo($youtube_id, EntityManagerInterface $entityManager){
        $video = $entityManager->getRepository(Video::class)->findBy(['youtube_id'=>$youtube_id]);
        $service = new UrlService($video);
        $url = $service->getUrl();
        return $this->render("video/single_video.html.twig", ['video'=>$url]);
    }

    #[Route('/video/category/{category_id}', name: 'show_video_by_categories', requirements: ["category_id" => "\d"])]
    public function showVideoByCategories($category_id, EntityManagerInterface $entityManager){
        $videos = $entityManager->getRepository(Video::class)->showByCategory($category_id);
        return $this->render('video/index.html.twig', ['videos'=>$videos]);
    }

    #[Route('/ajax_get', name: 'ajax_get')]
    public function getDescription(EntityManagerInterface $entityManager){
        $description = $entityManager->getRepository(DescriptionVideo::class)->findBy(['video'=>$_SESSION['Video']->getId()]);
        $comment = new GetCommentService($description);
        return $comment->GetComment();
    }


}
