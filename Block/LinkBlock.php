<?php

namespace Owp\OwpCore\Block;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\Service\AbstractBlockService;
use Sonata\BlockBundle\Mapper\FormMapper;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\Form\Validator\ErrorElement;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Owp\OwpCore\Entity\Link;
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
        return $this->renderResponse('Common/Block/link_block.html.twig', [
            'links'     => $this->linkRepository->findBy([]),
        ], $response);
    }
}
