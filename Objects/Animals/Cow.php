<?php

namespace Objects\Animals;

use Interfaces\AnimalInterface;

class Cow extends Animal implements AnimalInterface
{
    public const TYPE = 'cow';
    public const TYPE_MULTIPLE = 'cows';
    public const PRODUCE_NAME = 'milk';

    /**
     * Max amount of milk produced by this cow
     * @var int
     */
    private int $maxProduceAmount;

    /**
     * Cow constructor.
     * @param string $name
     */
    public function __construct(string $name = '')
    {
        $this->maxProduceAmount = rand(9, 12);
        parent::__construct($name);
    }

    /**
     *  Stringify cow with it's produce rate
     * @return string
     */
    public function toString(): string
    {
        return sprintf(
            "Cow №%d with name %s can produce 8-%d litters of milk",
            $this->getId(),
            $this->getName(),
            $this->maxProduceAmount
        );
    }

    /**
     * Returns litters of milk produced
     * @return int
     */
    public function collectProduce(): int
    {
        return rand(8, $this->maxProduceAmount);
    }
}
