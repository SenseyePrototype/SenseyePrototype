<?php

namespace AppBundle\Service;

use AppBundle\Entity\DeveloperProfile;
use Elastica\Document;

class DeveloperProfileStorage
{
    /**
     * @var DeveloperIndexService
     */
    private $indexService;

    /**
     * DeveloperProfileStorage constructor.
     * @param DeveloperIndexService $indexService
     */
    public function __construct(DeveloperIndexService $indexService)
    {
        $this->indexService = $indexService;
    }

    public function store(DeveloperProfile $profile)
    {
        $document = [
            'id' => $profile->getId(),
            'title' => $profile->getTitle(),
            'description' => $profile->getDescription(),
            'cities' => [],
            'salary' => $profile->getSalary(),
            'experience' => $profile->getExperience(),
            'expect' => $profile->getExpect(),
            'assert' => $profile->getAssert(),
            'link' => null,
            'skills' => [],
        ];

        $searchable = $this->indexService->getProfile();

        $searchable->addDocument(new Document("i.{$profile->getId()}", $document));

        $searchable->getIndex()->refresh();
    }
}
