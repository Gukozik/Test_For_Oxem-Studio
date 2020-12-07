<?php

namespace Cmd;

use Collections\Animals\AnimalsCollection;
use Exceptions\UnknownAnimalException;
use Objects\Animals\Chicken;
use Objects\Animals\Cow;
use Objects\Barn;

class Farm
{
    public const TYPES = [
        'c'         => Cow::TYPE,
        'cow'       => Cow::TYPE,
        'ch'        => Chicken::TYPE,
        'chicken'   => Chicken::TYPE,
    ];

    /**
     * @var Barn
     */
    private Barn $barn;

    /**
     * Total milk collected
     * @var int
     */
    private int $milkTotal = 0;

    /**
     * Total eggs collected
     * @var int
     */
    private int $eggsTotal = 0;

    /**
     * Farm constructor.
     * @param Barn $barn
     */
    public function __construct(Barn $barn)
    {
        $this->barn = $barn;
    }

    /**
     * Get the farm menu
     * @return string
     */
    public static function menu(): string
    {
        return
            'What would you like to do next?' . PHP_EOL .
            '  - Add new animals: "add"' . PHP_EOL .
            '  - Remove animals: "remove"' . PHP_EOL .
            '  - Collect produce: "collect"' . PHP_EOL .
            '  - List all the animals: "list"' . PHP_EOL .
            '  - Show total produce collected: "total"' . PHP_EOL .
            '  - Exit: "exit"' . PHP_EOL;
    }

    /**
     * Collect all of the animals produce
     * @return string
     */
    public function collect(): string
    {
        $product = $this->barn->collectProduct();
        $this->milkTotal += $product[Cow::PRODUCE_NAME];
        $this->eggsTotal += $product[Chicken::PRODUCE_NAME];
        return sprintf(
            'Got %d liters of milk and %d eggs' . PHP_EOL,
            $product[Cow::PRODUCE_NAME],
            $product[Chicken::PRODUCE_NAME]
        );
    }

    public function total(): string
    {
        return sprintf(
            'Collected so far: %d liters of milk and %d eggs' . PHP_EOL,
            $this->milkTotal,
            $this->eggsTotal
        );
    }

    /**
     * Add an animal to the farm
     * @param string $type
     * @param int $amount
     * @return string
     */
    public function add(string $type, int $amount): string
    {
        switch ($type) {
            case Cow::TYPE:
                $animal = Cow::class;
                $type = Cow::TYPE_MULTIPLE;
                break;

            case Chicken::TYPE:
                $animal = Chicken::class;
                $type = Chicken::TYPE_MULTIPLE;
                break;

            default:
                return 'Nothing was added because a wrong animal type was given.' . PHP_EOL;
        }

        for ($i = 0; $i < $amount; $i++){
            try {
                $this->barn->addAnimal(new $animal);
            } catch (UnknownAnimalException $e) {
                return sprintf(
                    'Only %d %s added because a wrong animal type was given.' . PHP_EOL,
                    $amount,
                    $type
                );
            }
        }

        return sprintf('Added %d %s.' . PHP_EOL, $amount, $type);
    }

    /**
     * Remove an animal from the farm
     * @param string $type
     * @param int $amount
     * @return string
     */
    public function remove(string $type, int $amount): string
    {
        for ($i = 0; $i < $amount; $i++){
            $this->barn->removeAnimal($type);
        }

        switch ($type) {
            case Cow::TYPE:
                $type = Cow::TYPE_MULTIPLE;
                break;

            case Chicken::TYPE:
                $type = Chicken::TYPE_MULTIPLE;
                break;

            default:
                return 'Nothing was removed because a wrong animal type was given.' . PHP_EOL;
        }

        return sprintf('Removed %d %s.' . PHP_EOL, $amount, $type);
    }

    /**
     * List all the animals on the farm
     * @return string
     */
    public function list(): string
    {
        $result = '';
        /** @var AnimalsCollection $animalsCollection */
        foreach ($this->barn->getAnimalsCollections() as $animalsCollection) {
            $result .= $animalsCollection->toString() . PHP_EOL;
        }

        return $result;
    }
}
