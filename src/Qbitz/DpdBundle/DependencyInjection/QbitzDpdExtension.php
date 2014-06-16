<?php

namespace Qbitz\DpdBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class QbitzDpdExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter('qbitz_dpd.wsdl',       $config['wsdl']);
        $container->setParameter('qbitz_dpd.login',      $config['login']);
        $container->setParameter('qbitz_dpd.password',   $config['password']);
        $container->setParameter('qbitz_dpd.fid',        $config['fid']);
        $container->setParameter('qbitz_dpd.output_dir', $config['output_dir']);
    }
}