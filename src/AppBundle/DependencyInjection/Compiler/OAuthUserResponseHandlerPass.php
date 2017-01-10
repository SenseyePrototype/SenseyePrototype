<?php

namespace AppBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class OAuthUserResponseHandlerPass
 * @package AppBundle\DependencyInjection\Compiler
 */
class OAuthUserResponseHandlerPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('app.oauth.user_response_handler_provider')) {
            return;
        }

        $definition = $container->getDefinition('app.oauth.user_response_handler_provider');
        $taggedServices = $container->findTaggedServiceIds('app.oauth.user_response_handler');

        foreach ($taggedServices as $id => $tags) {
            foreach ($tags as $attributes) {
                $definition->addMethodCall(
                    'addResponseHandler',
                    [
                        new Reference($id),
                        $attributes["alias"]
                    ]
                );
            }
        }
    }
}