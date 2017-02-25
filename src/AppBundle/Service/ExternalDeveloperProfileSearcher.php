<?php

namespace AppBundle\Service;

use AppBundle\Component\Profile;
use AppBundle\Component\ProfileInterface;
use AppBundle\Entity\ExternalDeveloperProfile;
use Doctrine\ORM\EntityRepository;

class ExternalDeveloperProfileSearcher
{
    /**
     * @var ProfileSearcher
     */
    private $searcher;

    /**
     * @var EntityRepository
     */
    private $repository;

    /**
     * ExternalDeveloperProfileSearcher constructor.
     * @param ProfileSearcher $searcher
     * @param EntityRepository $repository
     */
    public function __construct(ProfileSearcher $searcher, EntityRepository $repository)
    {
        $this->searcher = $searcher;
        $this->repository = $repository;
    }

    /**
     * @param $id
     * @return ProfileInterface
     */
    public function find($id)
    {
        try {
            return $this->searcher->find($id);
        } catch (\Exception $e) {
            // NOP
        }

        /* @var $entity ExternalDeveloperProfile */
        $entity = $this->repository->find($id);

        if (empty($entity)) {
            return null;
        }

        return new Profile($id, [
            'title' => $entity->getTitle(),
            'description' => $entity->getDescription(),
            'link' => $entity->getLink(),
            'skills' => [],
            'cities' => [],
            'salary' => null,
            'experience' => $entity->getExternalId(),
            'assert' => null,
            'expect' => null,
            'created' => $entity->getCreated()->format('Y-m-d H:i:s'),
        ]);
    }
}
