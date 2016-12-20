<?php

namespace AppBundle\Component;

use ReenExeCubeTime\LightPaginator\Pager;

class ProfileSearchResponse
{
    /**
     * @var Pager
     */
    private $pager;

    /**
     * @return Pager
     */
    public function getPager()
    {
        return $this->pager;
    }
}
