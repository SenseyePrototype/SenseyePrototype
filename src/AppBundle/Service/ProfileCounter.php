<?php

namespace AppBundle\Service;

use AppBundle\Component\ProfileCounterResponse;
use Symfony\Component\HttpFoundation\Request;

class ProfileCounter
{
    /**
     * @var ProfileAvailableCriteriaRepository
     */
    private $criteriaRepository;

    /**
     * @var ProfileSearchRequestAnalyzer
     */
    private $requestAnalyzer;

    /**
     * @var DeveloperIndexService
     */
    private $indexService;

    /**
     * @var ProfileSearchBuilder
     */
    private $builder;

    /**
     * ProfileCounter constructor.
     * @param ProfileAvailableCriteriaRepository $criteriaRepository
     * @param ProfileSearchRequestAnalyzer $requestAnalyzer
     * @param DeveloperIndexService $indexService
     * @param ProfileSearchBuilder $builder
     */
    public function __construct(ProfileAvailableCriteriaRepository $criteriaRepository, ProfileSearchRequestAnalyzer $requestAnalyzer, DeveloperIndexService $indexService, ProfileSearchBuilder $builder)
    {
        $this->criteriaRepository = $criteriaRepository;
        $this->requestAnalyzer = $requestAnalyzer;
        $this->indexService = $indexService;
        $this->builder = $builder;
    }

    public function getCounter(Request $request)
    {
        $available = $this->criteriaRepository->get();

        $criteria = $this->requestAnalyzer->analyze($available, $request);

        $searchable = $this->indexService->getProfile();

        $query = $this->builder->build($criteria);

        $count = $searchable->count($query);

        return new ProfileCounterResponse($count, [], [], []);
    }
}
