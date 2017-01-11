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
     * @var ProfileSearcher
     */
    private $searcher;

    /**
     * ProfileCounter constructor.
     * @param ProfileAvailableCriteriaRepository $criteriaRepository
     * @param ProfileSearchRequestAnalyzer $requestAnalyzer
     * @param ProfileSearcher $searcher
     */
    public function __construct(ProfileAvailableCriteriaRepository $criteriaRepository, ProfileSearchRequestAnalyzer $requestAnalyzer, ProfileSearcher $searcher)
    {
        $this->criteriaRepository = $criteriaRepository;
        $this->requestAnalyzer = $requestAnalyzer;
        $this->searcher = $searcher;
    }

    public function getCounter(Request $request)
    {
        $available = $this->criteriaRepository->get();

        $criteria = $this->requestAnalyzer->analyze($available, $request);

        $count = $this->searcher->count($criteria);

        return new ProfileCounterResponse($count, [], [], []);
    }
}
