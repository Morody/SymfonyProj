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
    private $id;
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getUrl(){
        $urlPackage = new UrlPackage(
            'https://www.youtube.com/embed/',
            new StaticVersionStrategy(''));
        $url = $urlPackage->getUrl('/'.$this->id);
        return $url;
    }
}