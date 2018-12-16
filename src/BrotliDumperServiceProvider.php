<?php
namespace Drupal\brotli_dumper;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceProviderBase;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

/**
 * Modifies the core asset.css.dumper service.
 */
class BrotliDumperServiceProvider extends ServiceProviderBase
{

    /**
     *
     * {@inheritdoc}  :
    class: Drupal\Core\Asset\AssetDumper

     */
    public function alter(ContainerBuilder $container)
    {
        try {
            $definition = $container->getDefinition('asset.css.dumper');
        } catch (ServiceNotFoundException $e) {
            return;
        }
        $definition->setClass('Drupal\brotli_dumper\AssetDumper');
        try {
            $definition = $container->getDefinition('asset.JS.dumper');
        } catch (ServiceNotFoundException $e) {
            return;
        }
        $definition->setClass('Drupal\brotli_dumper\AssetDumper');
    }
}