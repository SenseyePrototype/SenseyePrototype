<?php

namespace AppBundle;

use AppBundle\DependencyInjection\Compiler\OAuthUserResponseConnectorPass;
use AppBundle\DependencyInjection\Compiler\OAuthUserResponseHandlerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AppBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new OAuthUserResponseHandlerPass());
        $container->addCompilerPass(new OAuthUserResponseConnectorPass());
    }
}
