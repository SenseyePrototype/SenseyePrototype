<?php

namespace AppBundle\Entity\Manager;

use AppBundle\Entity\SocialProfile;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;

class UserManager
{
    /**
     * @var EntityManager
     */
    private $manager;

    /**
     * UserManager constructor.
     *
     * @param EntityManager $manager
     */
    public function __construct(EntityManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param $id
     *
     * @return null|object
     */
    public function findOneByFacebookId($id)
    {
        return $this->getRepository()->findOneBy(['facebookId' => $id]);
    }

    /**
     * @param $id
     *
     * @return null|object
     */
    public function findOneByGoogleId($id)
    {
        return $this->getRepository()->findOneBy(['googleId' => $id]);
    }

    /**
     * @param $id
     *
     * @return null|object
     */
    public function findOneByLinkedinId($id)
    {
        return $this->getRepository()->findOneBy(['linkedinId' => $id]);
    }

    /**
     * @param $id
     *
     * @return null|object
     */
    public function findOneByGithubId($id)
    {
        return $this->getRepository()->findOneBy(['githubId' => $id]);
    }

    /**
     * @param $id
     *
     * @return null|object
     */
    public function findOneByBitbucketId($id)
    {
        return $this->getRepository()->findOneBy(['bitbucketId' => $id]);
    }

    /**
     * @param $username
     *
     * @return \AppBundle\Entity\User|null
     */
    public function findUserByUsername($username)
    {
        return $this->getRepository()->findOneBy(['username' => $username]);
    }

    /**
     * @param $socialCode
     * @param $profileId
     * @return SocialProfile
     */
    public function findBySocial($socialCode, $profileId)
    {
        return $this->getSocialRepository()->findByUnique($socialCode, $profileId);
    }

    /**
     * @param $email
     *
     * @return User|null
     */
    public function findUserByEmail($email)
    {
        return $this->getRepository()->findOneBy(['email' => $email]);
    }

    /**
     * @param User $user
     * @return User
     */
    public function save(User $user)
    {
        $this->manager->persist($user);
        $this->manager->flush($user);

        return $user;
    }

    public function refresh(User $user)
    {
        return $this->getRepository()->find($user->getId());
    }

    private function getRepository()
    {
        return $this->manager->getRepository(User::class);
    }

    private function getSocialRepository()
    {
        return $this->manager->getRepository(SocialProfile::class);
    }
}
