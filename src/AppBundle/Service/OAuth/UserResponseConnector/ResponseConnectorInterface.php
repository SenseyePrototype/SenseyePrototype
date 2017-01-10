<?php

namespace AppBundle\Service\OAuth\UserResponseConnector;

use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Interface ResponseConnectorInterface
 * @package AppBundle\Service\OAuth\UserResponseConnector
 */
interface ResponseConnectorInterface
{
    /**
     * @param UserInterface         $user
     * @param UserResponseInterface $response
     */
    public function connect(UserInterface $user, UserResponseInterface $response);

    /**
     * @param UserInterface         $user
     * @param UserResponseInterface $response
     */
    public function disconnect(UserInterface $user, UserResponseInterface $response);
}
