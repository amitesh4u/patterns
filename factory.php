<?php
/**
 * factory.php
 * Реализация паттерна Фабрика
 *
 * Паттерн позволяет определить общий интерфейс создания объектов (продуктов),
 * при этом позволяя субклассам выбирать конкретный продукт для создания
 *
 * Паттерн инкапсулирует создание объектов
 * 2е иерархии классов получилось в результате
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     Mediasite
 * @link        http://www.mediasite.ru/
 */

class Car
{
    protected $name = '';
    protected $engine = 'Diesel';
    protected $paintColor = 'White';
    protected $wheels = '16 inch';
    protected $body = 'Caravan';

    public function configure()
    {
        echo $this->name . '<br />' ;
        echo $this->engine . '<br />' ;
        echo $this->paintColor . '<br />' ;
        echo $this->wheels . '<br />' ;
        echo $this->body . '<br />' ;
    }

    public function assembleBody()
    {
        echo 'Body is assembled <br />' ;
    }

    public function installEngine()
    {
        echo 'Engine is in its place <br />' ;
    }

    public function paint()
    {
        echo 'Car is painted <br />' ;
    }

    public function installWheels()
    {
        echo 'Wheels are installed <br />' ;
    }
}

class DeutschGolf extends Car
{
    function __construct()
    {
        $this->name = 'Golf';
        $this->body = 'Hatchback';
    }
}

class DeutschPassat extends Car
{
    function __construct()
    {
        $this->name = 'Passat';
        $this->body = 'Sedan';
    }
}

class DeutschTiguan extends Car
{
    function __construct()
    {
        $this->name = 'Tiguan';
        $this->body = 'Crossover';
    }
}

class DeutschTouareg extends Car
{
    function __construct()
    {
        $this->name = 'Touareg';
        $this->body = 'Big Crossover';
    }
}

class RussianGolf extends Car
{
    function __construct()
    {
        $this->name = 'Golf';
        $this->body = 'Hatchback';
        $this->engine = 'Gasoline';
    }
}

class RussianPassat extends Car
{
    function __construct()
    {
        $this->name = 'Passat';
        $this->body = 'Sedan';
        $this->engine = 'Gasoline';
    }
}

class RussianTiguan extends Car
{
    function __construct()
    {
        $this->name = 'Tiguan';
        $this->body = 'Crossover';
        $this->engine = 'Gasoline';
    }
}

class RussianTouareg extends Car
{
    function __construct()
    {
        $this->name = 'Touareg';
        $this->body = 'Big Crossover';
        $this->engine = 'Gasoline';
    }
}

abstract class VolkswagenFacility
{
    public abstract function createCar($type);

    public function getCar($type)
    {
        $car = $this->createCar($type);

        $car->configure();
        $car->assembleBody();
        $car->installEngine();
        $car->paint();
        $car->installWheels();

        echo '<br />';

        return $car;
    }
}

class DeutschVolkswagenFacility extends VolkswagenFacility
{
    public function createCar($type)
    {
        $car = new Car();

        if ($type === 'Golf') {
            $car = new DeutschGolf();
        }
        if ($type === 'Passat') {
            $car = new DeutschPassat();
        }
        if ($type === 'Tiguan') {
            $car = new DeutschTiguan();
        }
        if ($type === 'Touareg') {
            $car = new DeutschTouareg();
        }

        return $car;
    }
}

class RussianVolkswagenFacility extends VolkswagenFacility
{
    public function createCar($type)
    {
        $car = new Car();

        if ($type === 'Golf') {
            $car = new RussianGolf();
        }
        if ($type === 'Passat') {
            $car = new RussianPassat();
        }
        if ($type === 'Tiguan') {
            $car = new RussianTiguan();
        }
        if ($type === 'Touareg') {
            $car = new RussianTouareg();
        }

        return $car;
    }
}

$facility = new RussianVolkswagenFacility();

$facility->getCar('Golf');
$facility->getCar('Passat');
$facility->getCar('Tiguan');
$facility->getCar('Touareg');