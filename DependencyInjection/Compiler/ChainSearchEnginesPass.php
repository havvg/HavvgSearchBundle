<?php

namespace Havvg\Bundle\SearchBundle\DependencyInjection\Compiler;

use Havvg\Bundle\DRYBundle\DependencyInjection\Compiler\AbstractTaggedCompilerPass;

class ChainSearchEnginesPass extends AbstractTaggedCompilerPass
{
    protected $tag = 'havvg_search.engine';
    protected $targetService = 'havvg_search.engine.chain';
    protected $targetMethod = 'addEngine';
}
