<?php

namespace AppBundle\Service\OAuth\UserResponseHandler;

use AppBundle\Exception\OAuthUserResponseHandlerNotFoundException;

/**
 * Interface ResponseHandlerProviderInterface
 * @package AppBundle\Service\OAuth\UserResponseHandler
 */
interface ResponseHandlerProviderInterface
{

    /**
     * @param ResponseHandlerInterface $responseHandler
     * @param string                   $alias
     */
    public function addResponseHandler(ResponseHandlerInterface $responseHandler, string $alias);

    /**
     * @param string $alias
     *
     * @throws OAuthUserResponseHandlerNotFoundException
     *
     * @return ResponseHandlerInterface
     */
    public function getResponseHandler(string $alias): ResponseHandlerInterface;
}