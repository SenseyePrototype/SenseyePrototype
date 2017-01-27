<?php

namespace AppBundle\Entity\Manager;

use AppBundle\Repository\UserRepository;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;

class UserManager
{

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserManager constructor.
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->userRepository = $entityManager->getRepository('AppBundle:User');
    }

    /**
     * @param $id
     *
     * @return null|object
     */
    public function findOneByFacebookId($id)
    {
        return $this->userRepository->findOneBy(['facebookId' => $id]);
    }

    /**
     * @param $id
     *
     * @return null|object
     */
    public function findOneByGoogleId($id)
    {
        return $this->userRepository->findOneBy(['googleId' => $id]);
    }

    /**
     * @param $id
     *
     * @return null|object
     */
    public function findOneByLinkedinId($id)
    {
        return $this->userRepository->findOneBy(['linkedinId' => $id]);
    }

    /**
     * @param $id
     *
     * @return null|object
     */
    public function findOneByGithubId($id)
    {
        return $this->userRepository->findOneBy(['githubId' => $id]);
    }

    /**
     * @param $id
     *
     * @return null|object
     */
    public function findOneByBitbucketId($id)
    {
        return $this->userRepository->findOneBy(['bitbucketId' => $id]);
    }

    /**
     * @param $username
     *
     * @return \AppBundle\Entity\User|null|object
     */
    public function findUserByUsername($username)
    {
        return $this->userRepository->findOneBy(['username' => $username]);
    }

    /**
     * @param $email
     *
     * @return \AppBundle\Entity\User|null|object
     */
    public function findUserByEmail($email)
    {
        return $this->userRepository->findOneBy(['email' => $email]);
    }

    /**
     * @param User $user
     */
    public function save(User $user)
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush($user);

        return $user;
    }

}
