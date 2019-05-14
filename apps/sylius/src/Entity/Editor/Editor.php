<?php

declare(strict_types=1);

namespace App\Entity\Editor;

use Sylius\Component\Resource\Model\ResourceInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="app_editor")
 * @package AppBundle\Entity
 */
class Editor implements ResourceInterface
{
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
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }
    
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }
    
    /**
     * @return mixed
     */
    public function getCode()
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
}
