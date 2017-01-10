<?php

namespace AppBundle\Service\OAuth\UserResponseHandler;

use AppBundle\Entity\User;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class LinkedinResponseHandler
 * @package AppBundle\Service\OAuth\UserResponseHandler
 */
class LinkedinResponseHandler extends AbstractResponseHandler
{

    /**
     * @param UserResponseInterface $response
     *
     * @return UserInterface|object
     */
    protected function getUserByResourceOwnerId(UserResponseInterface $response)
    {
        return $this->userManager->findOneByLinkedinId($response->getUsername());
    }

    /**
     * @param UserResponseInterface $response
     * @param UserInterface         $user
     *
     * @return UserInterface
     */
    protected function updateUserAccessToken(UserResponseInterface $response, UserInterface $user)
    {
        /** @var $user User  */
        $user->setLinkedinAccessToken($response->getAccessToken());

        return $user;
    }
}
