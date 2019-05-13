<?php

declare(strict_types=1);

namespace App\Fixture;

use Sylius\Bundle\CoreBundle\Fixture\AbstractResourceFixture;
use Sylius\Bundle\FixturesBundle\Fixture\AbstractFixture;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NintendoProductFixture extends AbstractFixture
{
    /** @var AbstractResourceFixture */
    private $productFixture;
    
    /** @var \Faker\Generator */
    private $faker;
    
    /** @var OptionsResolver */
    private $optionsResolver;
    
    public function __construct(AbstractResourceFixture $productFixture)
    {
        $this->productFixture = $productFixture;
        
        $this->faker = \Faker\Factory::create();
        $this->optionsResolver =
            (new OptionsResolver())
                ->setRequired('amount')
                ->setAllowedTypes('amount', 'int')
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'nintendo_product';
    }
    
    /**
     * {@inheritdoc}
     */
    public function load(array $options): void
    {
        $options = $this->optionsResolver->resolve($options);
        
        $products = [];
        $productsNames = $this->getUniqueNames($options['amount']);
        for ($i = 0; $i < $options['amount']; ++$i) {
            $products[] = [
                'name' => sprintf(
                    (rand(0,1) ? 'New ' : '') . (rand(0,1) ? 'Super ' : '') . 'Mario "%s" ' . (rand(0,1) ? 'Bros. ' : '') . (rand(0,1) ? 'Deluxe ' : ''),
                    $productsNames[$i]
                ),
                'code' => $this->faker->uuid,
                'images' => [
                    [
                        'path' => sprintf('%s/../Resources/fixtures/%s', __DIR__, 'mario-' . rand(1,3)  . '.jpg'),
                        'type' => 'main',
                    ],
                    [
                        'path' => sprintf('%s/../Resources/fixtures/%s', __DIR__, 'mario-' . rand(1,3)  . '.jpg'),
                        'type' => 'thumbnail',
                    ],
                ],
            ];
        }
        
        $this->productFixture->load(['custom' => $products]);
    }
    
    /**
     * {@inheritdoc}
     */
    protected function configureOptionsNode(ArrayNodeDefinition $optionsNode): void
    {
        $optionsNode
            ->children()
            ->integerNode('amount')->isRequired()->min(0)->end()
        ;
    }
    
    private function getUniqueNames(int $amount): array
    {
        $productsNames = [];
        
        for ($i = 0; $i < $amount; ++$i) {
            $name = $this->faker->word;
            while (in_array($name, $productsNames)) {
                $name = $this->faker->word;
            }
            $productsNames[] = $name;
        }
        
        return $productsNames;
    }
}
