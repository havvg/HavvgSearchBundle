<?php

namespace Havvg\Bundle\SearchBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Havvg\Bundle\SearchBundle\DependencyInjection\Compiler\ChainSearchEnginesPass;

class HavvgSearchBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ChainSearchEnginesPass());
    }
}
