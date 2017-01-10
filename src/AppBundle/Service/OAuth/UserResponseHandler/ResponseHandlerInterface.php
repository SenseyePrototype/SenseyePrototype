<?php

namespace AppBundle\Service\OAuth\UserResponseHandler;

use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Interface ResponseHandlerInterface
 * @package AppBundle\Service\OAuth\UserResponseHandler
 */
interface ResponseHandlerInterface
{

    /**
     * @param UserResponseInterface $response
     *
     * @return UserInterface
     */
    public function processOauthUserResponse(UserResponseInterface $response): UserInterface;
}