<?php

declare(strict_types=1);

namespace App\Fixture\Factory;

use App\Entity\Editor\EditorInterface;
use Sylius\Bundle\CoreBundle\Fixture\Factory\AbstractExampleFactory;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class EditorExampleFactory extends AbstractExampleFactory
{
    /** @var \Faker\Factory */
    private $faker;
    
    /** @var OptionsResolver */
    private $optionResolver;
    /**
     * @var FactoryInterface
     */
    private $factory;
    
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
        $this->faker = \Faker\Factory::create();
        $this->optionResolver = new OptionsResolver();
        $this->configureOptions($this->optionResolver);
    }
    
    /**
     * @param array $options
     * @return EditorInterface
     */
    public function create(array $options = [])
    {
        $options = $this->optionResolver->resolve($options);
        /** @var EditorInterface $editor */
        $editor = $this->factory->createNew();
        $editor->setCode($options['code']);
        $editor->setName($options['name']);
        $editor->setEmail($options['email']);
        
        return $editor;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    protected function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefault('name', function(Options $options): string {
                return $this->faker->company;
            })
            ->setDefault('code', function(Options $options): string {
                return $this->faker->uuid;
            })
            ->setDefault('email', function(Options $options): string {
                return $this->faker->email;
            })
        ;
    }
}
