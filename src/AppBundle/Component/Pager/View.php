<?php

namespace AppBundle\Component\Pager;

use Pagerfanta\PagerfantaInterface;
use Pagerfanta\View\ViewInterface;
use Symfony\Bundle\TwigBundle\TwigEngine;

class View implements ViewInterface
{
    /**
     * @var TwigEngine
     */
    private $templating;

    /**
     * View constructor.
     * @param TwigEngine $templating
     */
    public function __construct(TwigEngine $templating)
    {
        $this->templating = $templating;
    }

    public function render(PagerfantaInterface $pagerfanta, $routeGenerator, array $options = array())
    {
        return $this->templating->render('@App/Developer/block/pagination.html.twig');
    }

    public function getName()
    {
        return 'first';
    }
}
