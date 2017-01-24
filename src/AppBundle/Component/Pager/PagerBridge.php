<?php

namespace AppBundle\Component\Pager;

use Pagerfanta\Pagerfanta;
use ReenExeCubeTime\LightPaginator\PagerInterface;

class PagerBridge extends Pagerfanta
{
    /**
     * @var PagerInterface
     */
    private $pager;

    /**
     * PagerBridge constructor.
     * @param PagerInterface $pager
     */
    public function __construct(PagerInterface $pager)
    {
        $this->pager = $pager;
        $this->setMaxPerPage($pager->getPerPage());
        $this->setCurrentPage($pager->getCurrentPage());
    }

    public function getNbResults()
    {
        return $this->pager->getCount();
    }
}
