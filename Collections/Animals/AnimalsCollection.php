<?php

namespace Collections\Animals;

use Objects\Animals\Animal;

abstract class AnimalsCollection
{
    /**
     * @var Animal[] [$id => Animal $animal]
     */
    protected array $animals = [];

    /**
     * AnimalsCollection constructor.
     * @param array $animals
     */
    public abstract function __construct(array $animals = []);

    /**
     * Stringify the collection
     * @return string
     */
    public function toString(): string
    {
        $result = '';
        foreach ($this->animals as $animal) {
            $result .= $animal->toString() . PHP_EOL;
        }
        return $result;
    }

    /**
     * Collect all the produce from the animals
     * @return int
     */
    public function collectProduce(): int
    {
        $total = 0;
        foreach ($this->animals as $animal) {
            $total += $animal->collectProduce();
        }
        return $total;
    }

    /**
     * Ad an animal to the collection
     * @param Animal $animal
     */
    public function addAnimal(Animal $animal)
    {
        $this->animals[$animal->getId()] = $animal;
    }

    /**
     * Remove an animal from the collection
     * @param int $id
     */
    public function removeAnimal(int $id = 0)
    {
        if ($id) {
            unset($this->animals[$id]);
        } else {
            array_shift($this->animals);
        }
    }

    /**
     * Get all the animals in an array
     * @return Animal[]
     */
    public function getAnimals(): array
    {
        return $this->animals;
    }
}
