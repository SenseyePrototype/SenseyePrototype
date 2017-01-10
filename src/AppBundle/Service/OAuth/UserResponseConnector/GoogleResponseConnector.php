<?php

namespace AppBundle\Service\OAuth\UserResponseConnector;

use AppBundle\Entity\User;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class GoogleResponseConnector
 * @package AppBundle\Service\OAuth\UserResponseConnector
 */
class GoogleResponseConnector extends AbstractResponseConnector
{
    /**
     * @param UserInterface|User         $user
     * @param UserResponseInterface $response
     */
    public function connect(UserInterface $user, UserResponseInterface $response)
    {
        /** @var User $previousUser */
        $previousUser = $this->userManager->findOneByGoogleId($response->getUsername());

        if ($previousUser) {
            $this->disconnect($previousUser, $response);
        }

        //we connect current user
        $user->setGoogleId($response->getUsername());
        $user->setGoogleAccessToken($response->getAccessToken());
    }

    /**
     * @param UserInterface|User         $user
     * @param UserResponseInterface $response
     */
    public function disconnect(UserInterface $user, UserResponseInterface $response)
    {
        $user->setGoogleId(null);
        $user->setGoogleAccessToken(null);
        $this->userManager->save($user);
    }
}
