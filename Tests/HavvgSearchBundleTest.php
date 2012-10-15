<?php

namespace Havvg\Bundle\SearchBundle\Tests;

use Havvg\Bundle\SearchBundle\Tests\AbstractTest;
use Havvg\Bundle\SearchBundle\HavvgSearchBundle;

class HavvgSearchBundleTest extends AbstractTest
{
    /**
     * @covers Havvg\Bundle\SearchBundle\HavvgSearchBundle::build
     */
    public function testBuild()
    {
        $builder = $this->getMock('Symfony\Component\DependencyInjection\ContainerBuilder');
        $builder
            ->expects($this->once())
            ->method('addCompilerPass')
        ;

        $bundle = new HavvgSearchBundle();
        $bundle->build($builder);
    }
}
