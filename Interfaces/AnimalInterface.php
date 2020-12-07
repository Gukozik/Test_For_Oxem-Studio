<?php


namespace Interfaces;


interface AnimalInterface
{
    /**
     * Stringify the animals with their produce rates
     * @return string
     */
    public function toString(): string;

    /**
     * Returns number of products produced
     * @return int
     */
    public function collectProduce(): int;
}
