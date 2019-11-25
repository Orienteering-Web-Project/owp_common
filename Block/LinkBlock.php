<?php

namespace Owp\OwpCore\Block;

use Symfony\Component\HttpFoundation\Response;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\Service\AbstractBlockService;
use Sonata\BlockBundle\Mapper\FormMapper;
use Symfony\Component\Templating\EngineInterface;
use Twig\Environment;
use Owp\OwpCore\Repository\LinkRepository;

final class LinkBlock extends AbstractBlockService
{
    private $linkRepository;

    public function __construct(Environment $templatingOrDeprecatedName, EngineInterface $templating, LinkRepository $linkRepository)
    {
        parent::__construct($templatingOrDeprecatedName, $templating);

        $this->linkRepository = $linkRepository;
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        return $this->renderResponse('@OwpCore/Common/Block/link_block.html.twig', [
            'links'     => $this->linkRepository->findBy([]),
        ], $response);
    }
}
