<?php

namespace AppBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class OAuthUserResponseConnectorPass
 * @package AppBundle\DependencyInjection\Compiler
 */
class OAuthUserResponseConnectorPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('app.oauth.user_response_connector_provider')) {
            return;
        }

        $definition = $container->getDefinition('app.oauth.user_response_connector_provider');
        $taggedServices = $container->findTaggedServiceIds('app.oauth.user_response_connector');

        foreach ($taggedServices as $id => $tags) {
            foreach ($tags as $attributes) {
                $definition->addMethodCall(
                    'addResponseConnector',
                    [
                        new Reference($id),
                        $attributes["alias"]
                    ]
                );
            }
        }
    }
}