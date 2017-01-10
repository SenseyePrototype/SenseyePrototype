<?php

namespace AppBundle\Service\OAuth\UserResponseMapper;

use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Interface ResponseMapperInterface
 * @package AppBundle\Service\OAuth\UserResponseMapper
 */
interface ResponseMapperInterface
{
    /**
     * @param UserResponseInterface $response
     * @param UserInterface         $user
     *
     * @return UserInterface
     */
    public function map(
        UserResponseInterface $response,
        UserInterface $user
    ): UserInterface;
}
