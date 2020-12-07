<?php

namespace Collections\Animals;

use Objects\Animals\Chicken;

class ChickensCollection extends AnimalsCollection
{
    /**
     * ChickensCollection constructor.
     * @param array $chickensArray
     */
    public function __construct(array $chickensArray = [])
    {
        foreach ($chickensArray as $chicken) {
            $this->addAnimal(new Chicken($chicken));
        }
    }
}
