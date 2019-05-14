<?php

declare(strict_types=1);

namespace App\Fixture;

use Sylius\Bundle\CoreBundle\Fixture\AbstractResourceFixture;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

final class EditorFixture extends AbstractResourceFixture
{
    
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'editor';
    }
    
    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        $resourceNode
            ->children()
            ->scalarNode('name')->cannotBeEmpty()->end()
            ->scalarNode('email')->cannotBeEmpty()->end()
            ->scalarNode('code')->cannotBeEmpty()->end()
        ;
    }
}
