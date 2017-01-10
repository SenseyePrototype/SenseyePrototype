<?php

namespace AppBundle\Service\OAuth\UserResponseConnector;

use AppBundle\Entity\User;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class FacebookResponseConnector
 * @package AppBundle\Service\OAuth\UserResponseConnector
 */
class FacebookResponseConnector extends AbstractResponseConnector
{
    /**
     * @param UserInterface|User         $user
     * @param UserResponseInterface $response
     */
    public function connect(UserInterface $user, UserResponseInterface $response)
    {
        /** @var User $previousUser */
        $previousUser = $this->userManager->findOneByFacebookId($response->getUsername());

        if ($previousUser) {
            $this->disconnect($previousUser, $response);
        }

        //we connect current user
        $user->setFacebookId($response->getUsername());
        $user->setFacebookAccessToken($response->getAccessToken());
    }

    /**
     * @param UserInterface|User         $user
     * @param UserResponseInterface $response
     */
    public function disconnect(UserInterface $user, UserResponseInterface $response)
    {
        $user->setFacebookId(null);
        $user->setFacebookAccessToken(null);
        $this->userManager->save($user);
    }
}
