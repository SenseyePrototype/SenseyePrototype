<?php

namespace AppBundle\Service\OAuth\UserResponseMapper;

use AppBundle\Entity\User;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class LinkedinResponseMapper
 * @package AppBundle\Service\OAuth\UserResponseMapper
 */
class LinkedinResponseMapper implements ResponseMapperInterface
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
        $now = new \DateTime();

        $user
            ->setUsername($response->getNickname())
            ->setLinkedinId($response->getUsername())
            ->setLinkedinAccessToken($response->getAccessToken())
            ->setEmail($response->getEmail())
            ->setCreated($now)
            ->setUpdated($now);

        return $user;
    }
}
