<?php

namespace Objects\Animals;

use Interfaces\AnimalInterface;

abstract class Animal implements AnimalInterface
{
    /**
     * Animal's name
     * @var string
     */
    protected string $name = '';

    /**
     * Animal constructor.
     * @param string $name
     */
    public function __construct(string $name = '')
    {
        $prefix = ($this::TYPE ?? 'Animal') . '#';
        $this->name = $name ?: ucfirst($prefix . substr(uniqid(), -4));
    }

    /**
     * Return unique animal id
     * @return int
     */
    public function getId(): int
    {
        return spl_object_id($this);
    }

    /**
     * Return animal's name
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
