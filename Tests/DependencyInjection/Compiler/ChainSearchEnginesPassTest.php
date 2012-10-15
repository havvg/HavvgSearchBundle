<?php

namespace Havvg\Bundle\SearchBundle\Tests\DependencyInjection\Compiler;

use Havvg\Bundle\SearchBundle\Tests\AbstractTest;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

use Havvg\Bundle\SearchBundle\DependencyInjection\Compiler\ChainSearchEnginesPass;

/**
 * @covers Havvg\Bundle\SearchBundle\DependencyInjection\Compiler\ChainSearchEnginesPass
 */
class ChainSearchEnginesPassTest extends AbstractTest
{
    public function testWithProvider()
    {
        $chainService = new Definition();
        $chainService->setClass('Havvg\Component\Search\Engine\ChainEngine');

        $engine = $this->getMock('Havvg\Component\Search\Engine\EngineInterface');
        $engineService = new Definition();
        $engineService->setClass(get_class($engine));
        $engineService->addTag('havvg_search.engine');

        $builder = new ContainerBuilder();
        $builder->addDefinitions(array(
            'havvg_search.engine.chain' => $chainService,
            'havvg_search.engine.example' => $engineService,
        ));

        $builder->addCompilerPass(new ChainSearchEnginesPass());
        $builder->compile();

        $this->assertNotEmpty($builder->getServiceIds(),
            'The services have been injected.');
        $this->assertNotEmpty($builder->get('havvg_search.engine.chain'),
            'The chained search engine service has been injected.');
        $this->assertNotEmpty($builder->get('havvg_search.engine.example'),
            'The example search engine service has been injected.');

        /*
         * Schema:
         *
         * [0] The list of methods.
         *   [0] The name of the method to call.
         *   [1] The arguments to pass into the method call.
         *     [0] First argument to pass into the method call.
         *     ...
         */
        $chainMethodCalls = $builder->getDefinition('havvg_search.engine.chain')->getMethodCalls();
        $this->assertNotEmpty($chainMethodCalls,
            'The chain engine got method calls added.');
        $this->assertEquals('addEngine', $chainMethodCalls[0][0],
            'The chain engine got an engine added.');
        $this->assertEquals('havvg_search.engine.example', $chainMethodCalls[0][1][0],
            'The chain engine got the correct engine added.');
    }

    protected function getBuilder()
    {
        $builder = $this->getMock('Symfony\Component\DependencyInjection\ContainerBuilder');

        return $builder;
    }
}
