<?php
/**
 * factoryContinue.php
 * Реализация паттерна Фабрика в более усложненном варианте
 *
 * Паттерн позволяет определить общий интерфейс создания объектов (продуктов),
 * при этом позволяя субклассам выбирать конкретный продукт для создания
 *
 * Паттерн инкапсулирует создание объектов
 * 2е иерархии классов получилось в результате
 *
 * Фабричный метод - использует наследование
 * Абстрактная фабрика - композицию
 * Фабричный метод - призван создавать лишь продукт
 * Абстрактная фабрика - семейство продуктов сразу
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     Mediasite
 * @link        http://www.mediasite.ru/
 */

abstract class Engine
{
}

class DieselEngine extends Engine
{
    function __construct()
    {
        echo 'Engine is diesel';
    }
}

class GasolineEngine extends Engine
{
    function __construct()
    {
        echo 'Engine is gasoline';
    }
}

abstract class Paint
{
}

class WhitePaint extends Paint
{
    function __construct()
    {
        echo 'Paint is White';
    }
}

class BlackPaint extends Paint
{
    function __construct()
    {
        echo 'Paint is Black';
    }
}

abstract class Wheels
{
}

class BigWheels extends Wheels
{
    function __construct()
    {
        echo 'Wheels are 17\"';
    }
}

class MediumWheels extends Wheels
{
    function __construct()
    {
        echo 'Wheels are 16\"';
    }
}

abstract class CarPartsFactory
{
    public abstract function createEngine();
    public abstract function createPaint();
    public abstract function createWheels();
}

class RussianCarPartsFactory extends CarPartsFactory
{
    public function createEngine()
    {
        return new GasolineEngine();
    }

    public function createPaint()
    {
        return new BlackPaint();
    }

    public function createWheels()
    {
        return new MediumWheels();
    }
}

class DeutschCarPartsFactory extends CarPartsFactory
{
    public function createEngine()
    {
        return new DieselEngine();
    }

    public function createPaint()
    {
        return new WhitePaint();
    }

    public function createWheels()
    {
        return new BigWheels();
    }
}

/**
 * Class Car
 * Базовый класс для машин
 */
abstract class Car
{
    protected $name = '';
    protected $body = 'Caravan';

    protected $engine;
    protected $paint;
    protected $wheels;

    public abstract function configure();

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

class Golf extends Car
{
    private $factory;

    function __construct($factory)
    {
        $this->factory = $factory;
        $this->name = 'Golf';
        $this->body = 'Hatchback';
        $this->engine = 'Gasoline';
    }

    public function configure()
    {
        echo $this->name . '<br />' ;
        echo $this->body . '<br />' ;

        $this->engine = $this->factory->CreateEngine();
        echo '<br />';
        $this->paint = $this->factory->CreatePaint();
        echo '<br />';
        $this->wheels = $this->factory->CreateWheels();
        echo '<br />';
    }
}

class Passat extends Car
{
    private $factory;

    function __construct($factory)
    {
        $this->factory = $factory;
        $this->name = 'Passat';
        $this->body = 'Sedan';
        $this->engine = 'Gasoline';
    }

    public function configure()
    {
        echo $this->name . '<br />' ;
        echo $this->body . '<br />' ;

        $this->engine = $this->factory->CreateEngine();
        echo '<br />';
        $this->paint = $this->factory->CreatePaint();
        echo '<br />';
        $this->wheels = $this->factory->CreateWheels();
        echo '<br />';
    }
}

class Tiguan extends Car
{
    private $factory;

    function __construct($factory)
    {
        $this->factory = $factory;
        $this->name = 'Tiguan';
        $this->body = 'Crossover';
        $this->engine = 'Gasoline';
    }

    public function configure()
    {
        echo $this->name . '<br />' ;
        echo $this->body . '<br />' ;

        $this->engine = $this->factory->CreateEngine();
        echo '<br />';
        $this->paint = $this->factory->CreatePaint();
        echo '<br />';
        $this->wheels = $this->factory->CreateWheels();
        echo '<br />';
    }
}

class Touareg extends Car
{
    private $factory;

    function __construct($factory)
    {
        $this->factory = $factory;
        $this->name = 'Touareg';
        $this->body = 'Big Crossover';
        $this->engine = 'Gasoline';
    }

    public function configure()
    {
        echo $this->name . '<br />' ;
        echo $this->body . '<br />' ;

        $this->engine = $this->factory->CreateEngine();
        echo '<br />';
        $this->paint = $this->factory->CreatePaint();
        echo '<br />';
        $this->wheels = $this->factory->CreateWheels();
        echo '<br />';
    }
}

/**
 * Class VolkswagenFacility
 * Абстрактный класс фабрики
 */
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

/**
 * Иерархия классов фабрики
 */
class DeutschVolkswagenFacility extends VolkswagenFacility
{
    public function createCar($type)
    {
        $carPartsFactory = new DeutschCarPartsFactory();

        if ($type === 'Golf') {
            return new Golf($carPartsFactory);
        }
        if ($type === 'Passat') {
            return new Passat($carPartsFactory);
        }
        if ($type === 'Tiguan') {
            return new Tiguan($carPartsFactory);
        }
        if ($type === 'Touareg') {
            return new Touareg($carPartsFactory);
        }

        return null;
    }
}

class RussianVolkswagenFacility extends VolkswagenFacility
{
    public function createCar($type)
    {
        $carPartsFactory = new RussianCarPartsFactory();

        if ($type === 'Golf') {
            return new Golf($carPartsFactory);
        }
        if ($type === 'Passat') {
            return new Passat($carPartsFactory);
        }
        if ($type === 'Tiguan') {
            return new Tiguan($carPartsFactory);
        }
        if ($type === 'Touareg') {
            return new Touareg($carPartsFactory);
        }

        return null;
    }
}

/**
 * Отображение результатов
 */
$facility = new RussianVolkswagenFacility();

$facility->getCar('Golf');
$facility->getCar('Passat');
$facility->getCar('Tiguan');
$facility->getCar('Touareg');

$facility = new DeutschVolkswagenFacility();

$facility->getCar('Golf');
$facility->getCar('Passat');
$facility->getCar('Tiguan');
$facility->getCar('Touareg');