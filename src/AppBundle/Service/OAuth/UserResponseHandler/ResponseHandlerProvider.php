<?php

namespace AppBundle\Service\OAuth\UserResponseHandler;

use AppBundle\Exception\OAuthResponseHandlerLogicException;
use AppBundle\Exception\OAuthUserResponseHandlerNotFoundException;

/**
 * Class ResponseHandlerProvider
 * @package AppBundle\Service\OAuth\UserResponseHandler
 */
class ResponseHandlerProvider implements ResponseHandlerProviderInterface
{
    /**
     * @var ResponseHandlerInterface[]
     */
    private $resourceOwners = [];

    /**
     * @param ResponseHandlerInterface $responseHandler
     * @param string                 $alias
     */
    public function addResponseHandler(ResponseHandlerInterface $responseHandler, string $alias)
    {
        if (array_key_exists($alias, $this->resourceOwners)) {
            throw new OAuthResponseHandlerLogicException(
                'Response handler with alias - ' . $alias . ' has been registered previously'
            );
        }

        $this->resourceOwners[$alias] = $responseHandler;
    }

    /**
     * @param string $alias
     *
     * @return ResponseHandlerInterface
     * @throws OAuthUserResponseHandlerNotFoundException
     */
    public function getResponseHandler(string $alias): ResponseHandlerInterface
    {
        if (!array_key_exists($alias, $this->resourceOwners)) {
            throw new OAuthUserResponseHandlerNotFoundException(
                'There is not any registered response handlers with tag alias - ' . $alias
            );
        }

        return $this->resourceOwners[$alias];
    }
}
