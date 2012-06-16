<?php

namespace Vandpipe\Form\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author Henrik Bjornskov <henrik@bjrnskov.dk>
 */
class RemoveGuesserPass implements \Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if ($container->hasDefinition('form.extension')) {
            $container->getDefinition('form.extension')->replaceArgument(3, array());
        }
    }
}
