<?php

namespace AppBundle\Service\OAuth\UserResponseConnector;

use AppBundle\Exception\OAuthResponseConnectorLogicException;
use AppBundle\Exception\OAuthUserResponseConnectorNotFoundException;

/**
 * Class ResponseConnectorProvider
 * @package AppBundle\Service\OAuth\UserResponseConnector
 */
class ResponseConnectorProvider implements ResponseConnectorProviderInterface
{
    /**
     * @var array
     */
    private $responseConnectors = [];

    /**
     * @param ResponseConnectorInterface $responseConnector
     * @param string                     $alias
     */
    public function addResponseConnector(ResponseConnectorInterface $responseConnector, string $alias)
    {
        if (array_key_exists($alias, $this->responseConnectors)) {
            throw new OAuthResponseConnectorLogicException(
                'Response connector with alias - '. $alias . ' has been registered previously'
            );
        }

        $this->responseConnectors[$alias] = $responseConnector;
    }

    /**
     * @param string $alias
     *
     * @return ResponseConnectorInterface
     * @throws OAuthUserResponseConnectorNotFoundException
     */
    public function getResponseConnector(string $alias): ResponseConnectorInterface
    {
        if (!array_key_exists($alias, $this->responseConnectors)) {
            throw new OAuthUserResponseConnectorNotFoundException(
                'There is not any registered response connectors with tag alias - ' . $alias
            );
        }

        return $this->responseConnectors[$alias];
    }
}
