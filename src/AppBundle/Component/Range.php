<?php

namespace AppBundle\Component;

class Range
{
    /**
     * @var int|null
     */
    private $from;

    /**
     * @var int|null
     */
    private $to;

    /**
     * Range constructor.
     * @param int|null $from
     * @param int|null $to
     */
    public function __construct($from = null, $to = null)
    {
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * @return int|null
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @return int|null
     */
    public function getTo()
    {
        return $this->to;
    }
}
