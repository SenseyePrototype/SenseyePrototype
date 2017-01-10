<?php

namespace AppBundle\Service\OAuth\UserResponseConnector;

use AppBundle\Entity\Manager\UserManager;

/**
 * Class AbstractResponseConnector
 * @package AppBundle\Service\OAuth\UserResponseConnector
 */
abstract class AbstractResponseConnector implements ResponseConnectorInterface
{
    /**
     * @var UserManager
     */
    protected $userManager;

    /**
     * AbstractResponseConnector constructor.
     *
     * @param UserManager $userManager
     */
    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }
}

