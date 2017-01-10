<?php

namespace AppBundle\Service\OAuth\UserResponseMapper;

use AppBundle\Entity\User;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class FacebookResponseMapper
 * @package AppBundle\Service\OAuth\UserResponseMapper
 */
class FacebookResponseMapper implements ResponseMapperInterface
{
    /**
     * @param UserResponseInterface $response
     * @param UserInterface|User    $user
     *
     * @return UserInterface
     */
    public function map(
        UserResponseInterface $response,
        UserInterface $user
    ): UserInterface
    {
        $user->setFacebookId($response->getUsername());
        $user->setFacebookAccessToken($response->getAccessToken());

        return $user;
    }
}
