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
     * @var Profile[]
     */
    private $results;

    /**
     * ProfileSearchResponse constructor.
     * @param PagerInterface $pager
     * @param Profile[] $results
     */
    public function __construct(PagerInterface $pager, array $results)
    {
        $this->pager = $pager;
        $this->results = $results;
    }

    /**
     * @return PagerInterface
     */
    public function getPager()
    {
        return $this->pager;
    }

    public function getResults()
    {
        return $this->results;
    }
}
