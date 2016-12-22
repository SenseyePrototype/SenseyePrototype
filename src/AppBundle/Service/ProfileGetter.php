<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\Request;

class ProfileGetter
{
    /**
     * @var ProfileSearcher
     */
    private $searcher;

    /**
     * @var ProfileAvailableCriteriaRepository
     */
    private $criteriaRepository;

    /**
     * @var ProfileSearchRequestAnalyzer
     */
    private $analyzer;

    /**
     * ProfileGetter constructor.
     * @param ProfileSearcher $searcher
     * @param ProfileAvailableCriteriaRepository $criteriaRepository
     * @param ProfileSearchRequestAnalyzer $analyzer
     */
    public function __construct(ProfileSearcher $searcher, ProfileAvailableCriteriaRepository $criteriaRepository, ProfileSearchRequestAnalyzer $analyzer)
    {
        $this->searcher = $searcher;
        $this->criteriaRepository = $criteriaRepository;
        $this->analyzer = $analyzer;
    }

    public function search(Request $request)
    {
        $available = $this->criteriaRepository->get();

        $criteria = $this->analyzer->analyze($available, $request);

        return $this->searcher->search($criteria);
    }
}
