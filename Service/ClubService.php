<?php

namespace Owp\OwpCore\Service;

use Owp\OwpEvent\Entity\Club;
use Owp\OwpCore\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Security;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use SSymfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Owp\OwpCore\Repository\ClubRepository;

class ClubService {

    private $clubRepository;
    private $security;

    public function __construct(ClubRepository $clubRepository, Security $security)
    {
        $this->clubRepository = $clubRepository;
        $this->security = $security;
    }

    public function getBy(array $filters = [], $order = ['id' => 'ASC'])
    {
        return $this->clubRepository->findBy($filters, $order);
    }

    public function get(string $id)
    {
        if (empty($id)) {
            $user = $this->security->getUser();
            $id = ($user instanceof User && !empty($user->getBase())) ? $user->getBase()->getClub() : $_ENV['CLUB'];
        }

        return $this->clubRepository->find($id);
    }
}
