<?php

namespace Owp\OwpCore\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function index(): Response
    {
        return $this->render('@OwpCore/Homepage/homepage.html.twig', [
            'news' => $this->has('service.news') ? $this->get('service.news')->getBy() : [],
        ]);
    }
}
