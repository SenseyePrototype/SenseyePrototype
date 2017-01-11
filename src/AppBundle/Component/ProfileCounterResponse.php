<?php

namespace AppBundle\Component;

class ProfileCounterResponse
{
    /**
     * @var int
     */
    private $count;

    /**
     * @var array
     */
    private $multi;

    /**
     * @var array
     */
    private $must;

    /**
     * @var array
     */
    private $range;

    /**
     * ProfileCounterResponse constructor.
     * @param int $count
     * @param array $multi
     * @param array $must
     * @param array $range
     */
    public function __construct($count, array $multi, array $must, array $range)
    {
        $this->count = $count;
        $this->multi = $multi;
        $this->must = $must;
        $this->range = $range;
    }

    public function getData()
    {
        return [
            'count' => $this->count,
            'multi' => $this->multi,
            'must' => $this->must,
            'range' => $this->range,
        ];
    }
}
