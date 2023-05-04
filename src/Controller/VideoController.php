<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\DescriptionVideo;
use App\Entity\User;
use App\Entity\Video;
use App\Services\GetCommentService;
use App\Services\GetVideoService;
use App\Services\SearchService;
use App\Services\UrlService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Request;

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
    public function addVideo(Request $request, UserInterface $user, EntityManagerInterface $entityManager):Response
    {
        $error = '';
        if (isset($_POST['add_video'])){

            $arr = $_POST['add_video'];
            $arr = preg_split("/\=/", parse_url($arr, PHP_URL_QUERY));

            $service = new GetVideoService();
            $service->GetVideo($arr[1]);
            $video = new Video($service->GetVideo($arr[1]), $arr[1], $user);

            $entityManager->persist($video);
            $entityManager->flush();

            return $this->redirect('/video');
        }
        return $this->render('video/add_video.html.twig', []);
    }

    #[Route('/video/{youtube_id}', name: 'show_video')]
    public function showOneVideo($youtube_id, EntityManagerInterface $entityManager, UserInterface $user, Request $request){
        $video = $entityManager->getRepository(Video::class)->findBy(['youtube_id'=>$youtube_id]);
        if (!empty($video)){
            $_SESSION['Video'] = $video[0];
            $category = $entityManager->getRepository(Category::class)->findBy(['id'=>$video[0]->category]);
            $service = new UrlService($video[0]->youtube_id);
            $url = $service->getUrl();
            return $this->render("video/single_video.html.twig", ['video'=>$url, 'category'=>$category[0]->getTitle()]);
        }
        else{
            $title = $request->get('title');
            $video = new Video($title, $youtube_id, $user);
            $entityManager->persist($video);
            $entityManager->flush();
            return new Response('Ok');
        }
    }

    #[Route('/video/category/{category_id}', name: 'show_video_by_categories')]
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
