<?php

namespace App\Form\Extension;

use App\Entity\Editor\Editor;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Sylius\Bundle\ProductBundle\Form\Type\ProductType;
use Symfony\Component\Form\FormTypeExtensionInterface;

/**
 * @method iterable getExtendedTypes()
 */
class ProductTypeExtension extends AbstractResourceType implements FormTypeExtensionInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('editor', EntityType::class, [
            'class' => Editor::class,
            'choice_label' => 'name',
            'choice_value' => 'code',
            'label' => 'app.ui.editor',
            'required' => false,
        ]);
    }
    
    public function getExtendedType(): string
    {
        return ProductType::class;
    }
}
