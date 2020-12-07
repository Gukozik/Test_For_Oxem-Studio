<?php

namespace Exceptions;

use Exception;
use Interfaces\AnimalInterface;

class UnknownAnimalException extends Exception
{
    /**
     * UnknownAnimalException constructor.
     * @param AnimalInterface $animal
     */
    public function __construct(AnimalInterface $animal)
    {
        parent::__construct(sprintf('Animal of class %s is unknown to this farm.', get_class($animal)));
    }
}
