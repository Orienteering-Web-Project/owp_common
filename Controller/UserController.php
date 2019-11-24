<?php

namespace Owp\OwpCore\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Owp\OwpCore\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    public function delete(User $user): Response
    {
        if (!$this->isGranted('delete', $user)) {
            throw $this->createAccessDeniedException('Vous n\'êtes par autorisé à consulter cette page.');
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute('owp_homepage');
    }
}
