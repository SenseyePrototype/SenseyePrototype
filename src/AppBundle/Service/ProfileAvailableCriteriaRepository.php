<?php

namespace AppBundle\Service;

use AppBundle\Component\ProfileAvailableCriteria;
use Elastica\Document;

class ProfileAvailableCriteriaRepository
{
    /**
     * @var string
     */
    private $id = 'available';

    /**
     * @var DeveloperIndexService
     */
    private $indexService;

    /**
     * ProfileAvailableCriteriaRepository constructor.
     * @param DeveloperIndexService $indexService
     */
    public function __construct(DeveloperIndexService $indexService)
    {
        $this->indexService = $indexService;
    }

    public function get()
    {
        return new ProfileAvailableCriteria([], [], []);
    }

    public function store(array $available)
    {
        $type = $this->indexService->getFilter();

        $type->addDocument(new Document($this->id, $available));

        $type->getIndex()->refresh();
    }
}
