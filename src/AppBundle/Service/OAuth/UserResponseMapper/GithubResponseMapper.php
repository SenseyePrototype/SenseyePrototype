<?php

namespace AppBundle\Service\OAuth\UserResponseMapper;

use AppBundle\Entity\User;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class GithubResponseMapper
 * @package AppBundle\Service\OAuth\UserResponseMapper
 */
class GithubResponseMapper implements ResponseMapperInterface
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
            ->setGithubId($response->getUsername())
            ->setGithubAccessToken($response->getAccessToken())
            ->setEmail($response->getEmail())
            ->setCreated($now)
            ->setUpdated($now);

        return $user;
    }
}
