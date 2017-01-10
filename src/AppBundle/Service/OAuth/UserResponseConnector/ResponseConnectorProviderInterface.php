<?php

namespace AppBundle\Service\OAuth\UserResponseConnector;

use AppBundle\Exception\OAuthUserResponseHandlerNotFoundException;

/**
 * Interface ResponseConnectorProviderInterface
 * @package AppBundle\Service\OAuth\UserResponseHandler
 */
interface ResponseConnectorProviderInterface
{

    /**
     * @param ResponseConnectorInterface $responseConnector
     * @param string                     $alias
     */
    public function addResponseConnector(ResponseConnectorInterface $responseConnector, string $alias);

    /**
     * @param string $alias
     *
     * @throws OAuthUserResponseHandlerNotFoundException
     *
     * @return ResponseConnectorInterface
     */
    public function getResponseConnector(string $alias): ResponseConnectorInterface;
}