<?php
namespace Application\Sonata\MediaBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class OverrideServiceCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('sonata.media.admin.gallery');
        $definition->setClass('Application\Sonata\MediaBundle\Admin\GalleryAdmin');
    }
}
?>
