<?php

namespace UnaGauchada\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
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

    public function editShowAction(){
        //return $this->render('UserBundle:Profile:profile.html.twig');
        return $this->render('UserBundle:EditProfile:editProfile.html.twig');
    }

    public function editAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $auxUser = new User;
        $auxUser
            ->setName($user->getName())
            ->setLastName($user->getLastName())
            ->setEmail($user->getEmail())
            ->setPhone($user->getPhone());

        $user
            ->setName($request->get('name'))
            ->setLastName($request->get('lastName'))
            ->setEmail($request->get('email'))
            ->setPhone($request->get('phone'));
        if($request->files->get('image')){
            $user->setImageBlob($request->files->get('image'));
        }

        try {
            $em->persist($user);
            $em->flush();
        } catch (\Doctrine\DBAL\Exception\UniqueConstraintViolationException $e) {
            $user
                ->setName($auxUser->getName())
                ->setLastName($auxUser->getLastName())
                ->setEmail($auxUser->getEmail())
                ->setPhone($auxUser->getPhone());
            return $this->render('UserBundle:EditProfile:editProfile.html.twig', array('emailUsed' => true, 'email' => $request->get('email')));
        }
        return $this->redirectToRoute('user_profile');
    }

    public function submissionsAction(){

    }


}
