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

    /**
     * @return ProfileAvailableCriteria
     */
    public function get()
    {
        $resultSet = $this->indexService->getFilter()->getDocument($this->id);

        $data = $resultSet->getData();

        return new ProfileAvailableCriteria(
            $data['multi'],
            $data['must'],
            $data['range']
        );
    }

    public function store(array $available)
    {
        $type = $this->indexService->getFilter();

        $type->addDocument(new Document($this->id, $available));

        $type->getIndex()->refresh();
    }
}
