<?php

namespace App\Services;

use App\Entity\User;
use App\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Asset\UrlPackage;
use Symfony\Component\Asset\VersionStrategy\StaticVersionStrategy;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class UrlService{
    private $video;
    public function __construct($video)
    {
        $this->video = $video;
    }

    public function getUrl(){
        $urlPackage = new UrlPackage(
            'https://www.youtube.com/embed/',
            new StaticVersionStrategy(''));
        $url = $urlPackage->getUrl('/'.$this->video[0]->youtube_id);
        $_SESSION['Video'] = $this->video[0];
        return $url;
    }
}