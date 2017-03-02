<?php

namespace AppBundle\Service;

use AppBundle\Entity\DeveloperProfile;
use AppBundle\Entity\DeveloperProfileCityLink;
use AppBundle\Entity\DeveloperProfileSkillLink;
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
        $skills = [];

        /* @var $skillLink DeveloperProfileSkillLink */
        foreach ($profile->getSkillLinks() as $skillLink) {
            $skill = $skillLink->getSkill();
            $skills[] = [
                'alias' => $skill->getAlias(),
                'name' => $skill->getName(),
                'score' => $skillLink->getScore(),
            ];
        }

        $cities = [];
        /* @var $cityLink DeveloperProfileCityLink */
        foreach ($profile->getCityLinks() as $cityLink) {
            $city = $cityLink->getCity();
            $cities[] = [
                'alias' => $city->getAlias(),
                'name' => $city->getName(),
            ];
        }

        $document = [
            'id' => $profile->getId(),
            'title' => $profile->getTitle(),
            'description' => $profile->getDescription(),
            'cities' => $cities,
            'salary' => $profile->getSalary(),
            'experience' => $profile->getExperience(),
            'expect' => $profile->getExpect(),
            'assert' => $profile->getAssert(),
            'link' => null,
            'skills' => $skills,
        ];

        $searchable = $this->indexService->getProfile();

        $searchable->addDocument(new Document("i.{$profile->getId()}", $document));

        $searchable->getIndex()->refresh();
    }
}
