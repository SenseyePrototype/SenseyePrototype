<?php

namespace AppBundle\Service\OAuth;

use AppBundle\Entity\Manager\UserManager;
use AppBundle\Entity\User;
use AppBundle\Service\OAuth\UserResponseConnector\ResponseConnectorProviderInterface;
use AppBundle\Service\OAuth\UserResponseHandler\ResponseHandlerProviderInterface;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Connect\AccountConnectorInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthAwareUserProviderInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Class OAuthUserProvider
 * @package AppBundle\Security
 */
class OAuthUserProvider implements UserProviderInterface, AccountConnectorInterface, OAuthAwareUserProviderInterface
{
    const SESSION_ATTR_INSUFFICIENT_DATA = 'oauth_insufficient_data';

    /**
     * @var ResponseHandlerProviderInterface
     */
    private $responseHandlerProvider;

    /**
     * @var ResponseConnectorProviderInterface
     */
    private $responseConnectorProvider;

    /**
     * @var UserManager
     */
    private $userManager;

    /**
     * OAuthUserProvider constructor.
     *
     * @param ResponseHandlerProviderInterface   $responseHandlerProvider
     * @param ResponseConnectorProviderInterface $responseConnectorProvider
     * @param UserManager                        $userManager
     */
    public function __construct(
        ResponseHandlerProviderInterface $responseHandlerProvider,
        ResponseConnectorProviderInterface $responseConnectorProvider,
        UserManager $userManager
    ) {
        $this->responseHandlerProvider = $responseHandlerProvider;
        $this->responseConnectorProvider = $responseConnectorProvider;
        $this->userManager = $userManager;
    }

    /**
     * @AccountConnectorInterface
     *
     * Connects the response to the user object.
     *
     * @param UserInterface         $user     The user object
     * @param UserResponseInterface $response The oauth response
     */
    public function connect(UserInterface $user, UserResponseInterface $response)
    {
        $resourceOwnerName = $response->getResourceOwner()->getName();
        $responseConnector = $this->responseConnectorProvider->getResponseConnector($resourceOwnerName);

        $responseConnector->connect($user, $response);
    }

    /**
     * @OAuthAwareUserProviderInterface
     *
     * Loads the user by a given UserResponseInterface object.
     *
     * @param UserResponseInterface $response
     *
     * @return UserInterface
     *
     * @throws UsernameNotFoundException if the user is not found
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $resourceOwnerName = $response->getResourceOwner()->getName();
        $responseHandler = $this->responseHandlerProvider->getResponseHandler($resourceOwnerName);

        return $responseHandler->processOauthUserResponse($response);
    }

    /**
     *
     * @UserProviderInterface
     *
     * Loads the user for the given username.
     *
     * This method must throw UsernameNotFoundException if the user is not
     * found.
     *
     * @param string $username The username
     *
     * @return UserInterface
     *
     * @see UsernameNotFoundException
     *
     * @throws UsernameNotFoundException if the user is not found
     */
    public function loadUserByUsername($username)
    {
        return $this->userManager->findUserByUsername($username);
    }

    /**
     * @UserProviderInterface
     *
     * Refreshes the user for the account interface.
     *
     * It is up to the implementation to decide if the user data should be
     * totally reloaded (e.g. from the database), or if the UserInterface
     * object can just be merged into some internal array of users / identity
     * map.
     *
     * @param UserInterface $user
     *
     * @return UserInterface
     *
     * @throws UnsupportedUserException if the account is not supported
     */
    public function refreshUser(UserInterface $user)
    {
        return $user;
    }

    /**
     * @UserProviderInterface
     *
     * Whether this provider supports the given user class.
     *
     * @param string $class
     *
     * @return bool
     */
    public function supportsClass($class)
    {
        return ($class instanceof UserInterface && $class instanceof User);
    }
}
