<?php

namespace Havvg\Bundle\SearchBundle\Tests\DependencyInjection;

use Havvg\Bundle\SearchBundle\Tests\AbstractTest;

use Symfony\Component\DependencyInjection\ContainerBuilder;

use Havvg\Bundle\SearchBundle\DependencyInjection\HavvgSearchExtension;

/**
 * @covers Havvg\Bundle\SearchBundle\DependencyInjection\HavvgSearchExtension::load
 */
class HavvgSearchExtensionTest extends AbstractTest
{
    public function testLoadProvidedYaml()
    {
        $builder = new ContainerBuilder();

        $extension = new HavvgSearchExtension();
        $extension->load(array(), $builder);

        $this->assertTrue($builder->has('havvg_search.engine.chain'),
            'The chained search engine service has been injected.');
    }
}
