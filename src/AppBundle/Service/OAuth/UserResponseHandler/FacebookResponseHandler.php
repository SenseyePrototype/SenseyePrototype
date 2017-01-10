<?php

namespace AppBundle\Service\OAuth\UserResponseHandler;

use AppBundle\Entity\User;
use AppBundle\Library\Utils\SimpleLogger;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class FacebookResponseHandler
 * @package AppBundle\Service\OAuth\UserResponseHandler
 */
class FacebookResponseHandler extends AbstractResponseHandler
{

    /**
     * @param UserResponseInterface $response
     *
     * @return UserInterface|object
     */
    protected function getUserByResourceOwnerId(UserResponseInterface $response)
    {
        return $this->userManager->findOneByFacebookId($response->getUsername());
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
        $user->setFacebookAccessToken($response->getAccessToken());

        return $user;
    }
}
