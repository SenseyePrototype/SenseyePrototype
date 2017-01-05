<?php

namespace AppBundle\Component\Adapter;

use Elastica\Query;
use Elastica\ResultSet;
use Elastica\SearchableInterface;
use ReenExeCubeTime\LightPaginator\Adapter\AdapterInterface;

class ElasticAdapter implements AdapterInterface
{
    /**
     * @var SearchableInterface
     */
    private $searchable;

    /**
     * @var Query
     */
    private $query;

    /**
     * @var ResultSet
     */
    private $result;

    /**
     * ElasticAdapter constructor.
     * @param SearchableInterface $searchable
     * @param Query $query
     */
    public function __construct(SearchableInterface $searchable, Query $query)
    {
        $this->searchable = $searchable;
        $this->query = $query;
    }

    public function getCount()
    {
        return $this->result->getTotalHits();
    }

    public function getSlice($offset, $length)
    {
        return $this->result = $this->searchable->search($this->query, [
            'from' => $offset,
            'size' => $length,
        ]);
    }
}
