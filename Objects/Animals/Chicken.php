<?php

namespace Objects\Animals;

use Interfaces\AnimalInterface;

class Chicken extends Animal implements AnimalInterface
{
    public const TYPE = 'chicken';
    public const TYPE_MULTIPLE = 'chickens';
    const PRODUCE_NAME = 'eggs';

    /**
     * Stringify chicken with it's produce rate
     * @return string
     */
    public function toString(): string
    {
        return sprintf(
            "Chicken №%d with name %s, can produces 0-1 %s.",
            $this->getId(),
            $this->getName(),
            self::PRODUCE_NAME
        );
    }

    /**
     * Returns number of eggs laid
     * @return int
     */
    public function collectProduce(): int
    {
        return rand(0, 1);
    }
}
