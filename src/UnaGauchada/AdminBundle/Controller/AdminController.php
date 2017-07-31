<?php

namespace UnaGauchada\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UnaGauchada\PublicationBundle\Entity\Achievement;
use UnaGauchada\PublicationBundle\PublicationBundle;
use UnaGauchada\UserBundle\Entity\User;

class AdminController extends Controller
{
    public function ratingAction()
    {
        $repository = $this->getDoctrine()
            ->getRepository(User::class);
        $query = $repository->createQueryBuilder('p')
            ->where('p.isAdmin = 0')
            ->getQuery();
        $users = $query->getResult();
        return $this->render('AdminBundle:RatingReport:userReport.html.twig', array('users' => $users));
    }

    public function achievementsAction()
    {
        $repository = $this->getDoctrine()->getRepository(Achievement::class);
        $query = $repository->createQueryBuilder('a')->orderBy('a.max', 'ASC')->getQuery();
        $achievements= $query->getResult();
        return $this->render('AdminBundle:Achievements:achievementsPage.html.twig', array('achievements' => $achievements));
    }

    public function editAchievementsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $achievements = $em->getRepository(Achievement::class)->findAll();
        foreach ($achievements as $achievement) {
            $em->remove($achievement);
        }
        $em->flush();
        $achievements = $request->request->all();
        $lastIcon = array_pop($achievements);
        $lastName = array_pop($achievements);
        $min = PHP_INT_MIN;
        for($i = 1; $i <= (count($achievements) / 3); $i++){
            $em->persist(new Achievement($achievements['campoNombre'.$i], $min, (int)$achievements['campoRango'.$i], $achievements['campoIcono'.$i]));
            $min = (int)$achievements['campoRango'.$i] + 1;
        }
        $em->persist(new Achievement($lastName, $min, PHP_INT_MAX, $lastIcon));

        $em->flush();

        $this->addFlash('notice', 'Los cambios se han guardado correctamente.');
        return $this->redirectToRoute('achievements_management');
    }

}
