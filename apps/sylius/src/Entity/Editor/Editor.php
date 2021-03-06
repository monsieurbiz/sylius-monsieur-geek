<?php

declare(strict_types=1);

namespace App\Entity\Editor;

use Sylius\Component\Resource\Model\CodeAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="app_editor")
 * @package App\Entity
 */
class Editor implements ResourceInterface, CodeAwareInterface, EditorInterface
{
    const STATE_NEW = 'new';
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status = self::STATE_NEW;
    
    
    /**
     * @return mixed
     */
    public function getId(): ?int
    {
        return $this->id;
    }
    
    /**
     * @param mixed $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }
    
    /**
     * @return mixed
     */
    public function getName(): ?string
    {
        return $this->name;
    }
    
    /**
     * @return mixed
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }
    
    /**
     * @param mixed $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }
    
    /**
     * @return mixed
     */
    public function getCode(): ?string
    {
        return $this->code;
    }
    
    /**
     * @param mixed $code
     */
    public function setCode($code): void
    {
        $this->code = $code;
    }
    
    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
    
    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
    
}
