<?php

namespace AppBundle\Service\OAuth\UserResponseHandler;

use AppBundle\Entity\User;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class GithubResponseHandler
 * @package AppBundle\Service\OAuth\UserResponseHandler
 */
class GithubResponseHandler extends AbstractResponseHandler
{

    /**
     * @param UserResponseInterface $response
     *
     * @return UserInterface|object
     */
    protected function getUserByResourceOwnerId(UserResponseInterface $response)
    {
        return $this->userManager->findOneByGithubId($response->getUsername());
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
        $user->setGithubAccessToken($response->getAccessToken());

        return $user;
    }
}
