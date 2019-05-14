<?php

namespace App\Entity\Editor;

interface EditorInterface
{
    /**
     * @return mixed
     */
    public function getId();
    
    /**
     * @param mixed $name
     */
    public function setName(?string $name): void;
    
    /**
     * @return mixed
     */
    public function getName(): ?string;
    
    /**
     * @return mixed
     */
    public function getEmail(): ?string;
    
    /**
     * @param mixed $email
     */
    public function setEmail(?string $email): void;
    
    /**
     * @return mixed
     */
    public function getCode(): ?string;
    
    /**
     * @param mixed $code
     */
    public function setCode($code): void;
}
