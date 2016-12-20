<?php

namespace AppBundle\Component;

use ReenExeCubeTime\LightPaginator\Pager;
use ReenExeCubeTime\LightPaginator\PagerInterface;

class ProfileSearchResponse
{
    /**
     * @var PagerInterface
     */
    private $pager;

    /**
     * ProfileSearchResponse constructor.
     * @param Pager $pager
     */
    public function __construct(PagerInterface $pager)
    {
        $this->pager = $pager;
    }

    /**
     * @return PagerInterface
     */
    public function getPager()
    {
        return $this->pager;
    }
}
