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
     * @var ProfileAvailableCriteria
     */
    private $criteria;

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
        return $this->criteria
            ? $this->criteria
            : $this->criteria = $this->fetch();
    }

    public function store(array $available)
    {
        $type = $this->indexService->getFilter();

        $type->addDocument(new Document($this->id, $available));

        $type->getIndex()->refresh();
    }

    private function fetch()
    {
        $resultSet = $this->indexService->getFilter()->getDocument($this->id);

        $data = $resultSet->getData();

        return new ProfileAvailableCriteria(
            $data['multi'],
            $data['must'],
            $data['range']
        );
    }
}
