<?php

declare(strict_types=1);

namespace App\Entity\Product;

use App\Entity\Editor\EditorInterface;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Sylius\Component\Core\Model\Product as BaseProduct;
use Sylius\Component\Product\Model\ProductTranslationInterface;

/**
 * @Entity
 * @Table(name="sylius_product")
 */
class Product extends BaseProduct
{
    /** @var EditorInterface|null
     *
     * @ManyToOne(targetEntity="App\Entity\Editor\EditorInterface")
     * @JoinColumn(name="app_editor_id", referencedColumnName="id", nullable=true)
     */
    private $editor;
    
    protected function createTranslation(): ProductTranslationInterface
    {
        return new ProductTranslation();
    }
    
    /**
     * @return EditorInterface|null
     */
    public function getEditor(): ?EditorInterface
    {
        return $this->editor;
    }
    
    /**
     * @param EditorInterface|null $editor
     */
    public function setEditor(?EditorInterface $editor): void
    {
        $this->editor = $editor;
    }
    
}
