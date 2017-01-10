<?php

namespace AppBundle\Service\OAuth\UserResponseConnector;

use AppBundle\Entity\User;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class BitbucketResponseConnector
 * @package AppBundle\Service\OAuth\UserResponseConnector
 */
class BitbucketResponseConnector extends AbstractResponseConnector
{
    /**
     * @param UserInterface|User         $user
     * @param UserResponseInterface $response
     */
    public function connect(UserInterface $user, UserResponseInterface $response)
    {
        /** @var User $previousUser */
        $previousUser = $this->userManager->findOneByBitbucketId($response->getUsername());

        if ($previousUser) {
            $this->disconnect($previousUser, $response);
        }

        //we connect current user
        $user->setBitbucketId($response->getUsername());
        $user->setBitbucketAccessToken($response->getAccessToken());
    }

    /**
     * @param UserInterface|User         $user
     * @param UserResponseInterface $response
     */
    public function disconnect(UserInterface $user, UserResponseInterface $response)
    {
        $user->setBitbucketId(null);
        $user->setBitbucketAccessToken(null);
        $this->userManager->save($user);
    }
}
