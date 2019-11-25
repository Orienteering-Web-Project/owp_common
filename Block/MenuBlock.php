<?php

namespace Owp\OwpCore\Block;

use Symfony\Component\HttpFoundation\Response;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\Service\AbstractBlockService;
use Symfony\Component\Templating\EngineInterface;
use Owp\OwpCore\Repository\MenuRepository;
use Twig\Environment;

final class MenuBlock extends AbstractBlockService
{
    private $menuRepository;

    public function __construct(Environment $templatingOrDeprecatedName, EngineInterface $templating, MenuRepository $menuRepository = null)
    {
        parent::__construct($templatingOrDeprecatedName, $templating);

        $this->menuRepository = $menuRepository;
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        return $this->renderResponse('@OwpCore/Common/Block/menu_block.html.twig', [
            'menus'     => $this->menuRepository->findBy([]),
        ], $response);
    }
}
