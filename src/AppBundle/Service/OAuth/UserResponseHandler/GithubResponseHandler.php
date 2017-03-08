<?php

namespace AppBundle\Service\OAuth\UserResponseHandler;

use AppBundle\Entity\SocialProfile;
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
     * TODO: DEPRECATED? (#111)
     * @param UserResponseInterface $response
     *
     * @return UserInterface|object
     */
    protected function getUserByResourceOwnerId(UserResponseInterface $response)
    {
        return $this->userManager->findBySocial(
            SocialProfile::SOCIAL_CODE_GITHUB,
            $response->getUsername()
        );
    }

    /**
     * TODO: DEPRECATED? (#111)
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
