<?php

namespace Application\Sonata\NewsBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class OverrideServiceCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('sonata.news.admin.post');
        
        $definition->addMethodCall('setSecurityContext',array(new \Symfony\Component\DependencyInjection\Reference('security.context')));
    }
}
?>
