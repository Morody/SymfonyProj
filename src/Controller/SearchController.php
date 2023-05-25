<?php

namespace App\Controller;

use App\Services\SearchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function index(Request $request): Response
    {
        if (isset($_POST['search'])) {
            $service = new SearchService();
            $video = $service->GetVideo($_POST['search']);
            return $this->render('search/index.html.twig', [
                'videos' => $video,
            ]);
        }
        return $this->render('search/index.html.twig');
    }
}
