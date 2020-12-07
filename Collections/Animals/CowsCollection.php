<?php

namespace Collections\Animals;

use Objects\Animals\Cow;

class CowsCollection extends AnimalsCollection
{
    /**
     * CowsCollection constructor.
     * @param array $cowsArray
     */
    public function __construct(array $cowsArray = [])
    {
        foreach ($cowsArray as $cow) {
            $this->addAnimal(new Cow($cow));
        }
    }
}
