<?php

namespace Objects;

use Collections\Animals\ChickensCollection;
use Collections\Animals\CowsCollection;
use Exceptions\UnknownAnimalException;
use Interfaces\AnimalInterface;
use Objects\Animals\Chicken;
use Objects\Animals\Cow;

class Barn
{
    /**
     * @var ChickensCollection
     */
    private ChickensCollection $chickens;

    /**
     * @var CowsCollection
     */
    private CowsCollection $cows;

    /**
     * Barn constructor.
     * @param array $animals ['cows' => [], 'chickens' => []]
     */
    public function __construct(array $animals = [])
    {
        $this->cows     = new CowsCollection($animals['cows'] ?? []);
        $this->chickens = new ChickensCollection($animals['chickens'] ?? []);
    }

    /**
     * Add an animal to the barn
     * @param AnimalInterface $animal
     * @throws UnknownAnimalException
     */
    public function addAnimal(AnimalInterface $animal)
    {
        switch (true) {
            case $animal instanceof Cow:
                $this->cows->addAnimal($animal);
                break;
            case $animal instanceof Chicken:
                $this->chickens->addAnimal($animal);
                break;
            default:
                throw new UnknownAnimalException($animal);
        }
    }

    /**
     * remove an animal from the barn
     * @param string $type
     */
    public function removeAnimal(string $type)
    {
        switch ($type) {
            case Cow::TYPE:
                $this->cows->removeAnimal();
                break;
            case Chicken::TYPE:
                $this->chickens->removeAnimal();
                break;
            default:
        }
    }

    /**
     * Returns all the animals in the barn in an array
     * @return array ['chickens' => ChickensCollection $chickens, 'cows' => CowsCollection $cows]
     */
    public function getAnimalsCollections(): array
    {
        return [
            Chicken::TYPE_MULTIPLE  => $this->chickens,
            Cow::TYPE_MULTIPLE      => $this->cows
        ];
    }

    /**
     * Collect all the products from animals in the barn
     * @return int[] ['milk' => , 'eggs' => ]
     */
    public function collectProduct(): array
    {
        return [
            Cow::PRODUCE_NAME => $this->cows->collectProduce(),
            Chicken::PRODUCE_NAME => $this->chickens->collectProduce()
        ];
    }
}
