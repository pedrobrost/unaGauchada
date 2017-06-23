<?php

namespace UnaGauchada\SecurityBundle\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use UnaGauchada\CreditBundle\Entity\Transaction;
use UnaGauchada\UserBundle\Entity\User;

class SecurityController extends Controller
{
    public function loginAction()
    {
        $authUtils = $this->get('security.authentication_utils');
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();
        return $this->render('UGSecurityBundle:Login:login.html.twig', array('error' => $error, 'lastUsername' => $lastUsername));
    }

    public function registerAction(){
        return $this->render('UGSecurityBundle:Register:register.html.twig');
    }

    public function signupAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        // create the user
        $user = new User();
        $user
            ->setName($request->get('name'))
            ->setLastName($request->get('lastName'))
            ->setEmail($request->get('email'))
            ->setIsAdmin(false)
            ->setPlainPassword($request->get('password'))
            ->setPassword('chunk')
            ->setSalt('chunk')
            ->setBirthday(new \DateTime($request->get('birthday')))
            ->setPhone($request->get('phone'));

        $repository = $this->getDoctrine()->getRepository('CreditBundle:TransactionReason');
        $reason = $repository->findOneByName('Initial');
        $reason->newTransactionFor($user);

        try {
            $em->persist($user);
            $em->flush();
        } catch (\Doctrine\DBAL\Exception\UniqueConstraintViolationException $e) {
            return $this->render('UGSecurityBundle:Register:register.html.twig', array('emailUsed' => true));
        }

        $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
        $this->get('security.token_storage')->setToken($token);
        $this->get('session')->set('_security_main', serialize($token));
        return $this->redirectToRoute('publication_homepage');
    }

    public function editPasswordAction(){
        return $this->render('UGSecurityBundle:Password:password.html.twig');
    }

    public function changePasswordAction(Request $request){
        $user = $this->getUser();
        $user
            ->setPlainPassword($request->get('password'))
            ->setPassword('chunk')
            ->setSalt('chunk');
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        
        return $this->redirectToRoute('user_profile');
    }

}
