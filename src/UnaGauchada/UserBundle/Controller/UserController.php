<?php

namespace UnaGauchada\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Response;
use UnaGauchada\UserBundle\Entity\User;

class UserController extends Controller
{
    public function photoAction(User $user){
        if(!$user->getPhoto()){
            $file = new File(__DIR__.'/../Resources/public/image/profile.jpg');
            $imageFile = fopen($file->getRealPath(), 'r');
            $imageContent = fread($imageFile, $file->getSize());
            fclose($imageFile);
            return new Response($imageContent, 200, array('Content-Type' => $file->getMimeType()));
        }
        return new Response(stream_get_contents($user->getPhoto()), 200, array('Content-Type' => $user->getPhotoMime()));
    }

    public function profileAction(){
        return $this->render('UserBundle:Profile:profile.html.twig');
    }

    public function submissionsAction(){

    }


}
