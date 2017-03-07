<?php

namespace AppBundle\Service\OAuth\UserResponseConnector;

use AppBundle\Entity\User;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class GithubResponseConnector
 * @package AppBundle\Service\OAuth\UserResponseConnector
 */
class GitHubResponseConnector extends AbstractResponseConnector
{
    /**
     * @param UserInterface|User         $user
     * @param UserResponseInterface $response
     */
    public function connect(UserInterface $user, UserResponseInterface $response)
    {
        /**
         * TODO: find for what use this method? (#111)
         */

        /** @var User $previousUser */
        $previousUser = $this->userManager->findOneByGithubId($response->getUsername());

        if ($previousUser) {
            $this->disconnect($previousUser, $response);
        }

        //we connect current user
        $user->setGithubId($response->getUsername());
        $user->setGithubAccessToken($response->getAccessToken());
    }

    /**
     * @param UserInterface|User         $user
     * @param UserResponseInterface $response
     */
    public function disconnect(UserInterface $user, UserResponseInterface $response)
    {
        $user->setGithubId(null);
        $user->setGithubAccessToken(null);
        $this->userManager->save($user);
    }
}
