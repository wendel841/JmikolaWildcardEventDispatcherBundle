<?php

namespace Jmikola\WildcardEventDispatcherBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class SetInnerEventDispatcherPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if ($container->hasAlias(EventDispatcherInterface::class)) {
            $container->setAlias('jmikola_wildcard_event_dispatcher.event_dispatcher.inner', new Alias((string) $container->getAlias(EventDispatcherInterface::class), false));
        } else {
            $definition = $container->getDefinition(EventDispatcherInterface::class);
            $definition->setPublic(false);
            $container->setDefinition('jmikola_wildcard_event_dispatcher.event_dispatcher.inner', $definition);
        }
    }
}
