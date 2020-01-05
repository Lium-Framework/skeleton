<?php

declare(strict_types=1);

namespace App;

use Lium\Framework\DependencyInjection\FrameworkExtension;
use Lium\Framework\Kernel as FrameworkKernel;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * The kernel of the application
 */
final class Kernel extends FrameworkKernel
{
    const CONFIG_EXTENSIONS = '.{php,xml,yaml,yml}';

    public function getProjectDir(): string
    {
        return dirname(__DIR__);
    }

    protected function configureContainer(ContainerBuilder $container, LoaderInterface $loader): void
    {
        $loader->load('{packages}/*'.self::CONFIG_EXTENSIONS, 'glob');
        $loader->load('{packages}/'.$this->env.'/**/*'.self::CONFIG_EXTENSIONS, 'glob');
        $loader->load('{services}'.self::CONFIG_EXTENSIONS, 'glob');
        $loader->load('{services}_'.$this->env.self::CONFIG_EXTENSIONS, 'glob');

        $this->addExtensions(new FrameworkExtension());
    }
}
