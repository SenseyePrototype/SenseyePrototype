<?php

namespace AppBundle\Service\OAuth\UserResponseMapper;

use AppBundle\Entity\User;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class BitbucketResponseMapper
 * @package AppBundle\Service\OAuth\UserResponseMapper
 */
class BitbucketResponseMapper implements ResponseMapperInterface
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
        $user->setBitbucketId($response->getUsername());
        $user->setBitbucketAccessToken($response->getAccessToken());

        return $user;
    }
}
