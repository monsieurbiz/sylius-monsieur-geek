<?php

declare(strict_types=1);

namespace App\Fixture\Factory;

use App\Entity\Editor\EditorInterface;
use SM\SMException;
use Sylius\Bundle\CoreBundle\Fixture\Factory\AbstractExampleFactory;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use SM\Factory\FactoryInterface as StateMachineFactoryInterface;

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
    
    /**
     * @var StateMachineFactoryInterface
     */
    private $stateMachineFactory;
    
    public function __construct(FactoryInterface $factory, StateMachineFactoryInterface $stateMachineFactory)
    {
        $this->factory = $factory;
        $this->stateMachineFactory = $stateMachineFactory;
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
        
        if ($this->faker->boolean(20)) {
            $stateMachineFactory = $this->stateMachineFactory->get($editor, 'app_editor');
            try {
                $stateMachineFactory->apply('approve');
            } catch (SMException $exception) {
                // Do nothing if SMException is thrown
            }
        }
    
    
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
