<?php

namespace AppBundle\Service\OAuth\UserResponseConnector;

use AppBundle\Entity\User;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class LinkedinResponseConnector
 * @package AppBundle\Service\OAuth\UserResponseConnector
 */
class LinkedInResponseConnector extends AbstractResponseConnector
{
    /**
     * @param UserInterface|User         $user
     * @param UserResponseInterface $response
     */
    public function connect(UserInterface $user, UserResponseInterface $response)
    {
        /** @var User $previousUser */
        $previousUser = $this->userManager->findOneByLinkedinId($response->getUsername());

        if ($previousUser) {
            $this->disconnect($previousUser, $response);
        }

        //we connect current user
        $user->setLinkedinId($response->getUsername());
        $user->setLinkedinAccessToken($response->getAccessToken());
    }

    /**
     * @param UserInterface|User         $user
     * @param UserResponseInterface $response
     */
    public function disconnect(UserInterface $user, UserResponseInterface $response)
    {
        $user->setLinkedinId(null);
        $user->setLinkedinAccessToken(null);
        $this->userManager->save($user);
    }
}
