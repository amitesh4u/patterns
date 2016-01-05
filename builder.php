<?php
/**
 * builder.php
 * Реализация паттерна Строитель
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     Mediasite LLC
 * @link        http://www.mediasite.ru/
*/

class Car
{
    public $engine;
    public $frame;
    public $wheels;
    public $luxury;
    public $multimedia;
    public $safety;

    public function __toString()
    {
        $str = '';
        $str = $str . 'Engine:     ' . $this->engine . '<br />';
        $str = $str . 'Frame:      ' . $this->frame . '<br />';
        $str = $str . 'Wheels:     ' . $this->wheels . '<br />';
        $str = $str . 'Luxury:     ' . $this->luxury . '<br />';
        $str = $str . 'Multimedia: ' . $this->multimedia . '<br />';
        $str = $str . 'Safety:     ' . $this->safety . '<br />';

        return $str;
    }
}

abstract class CarBuilderBase
{
    protected $car;

    function __construct($car)
    {
        $this->car = $car;
    }

    public function getCar()
    {
        return $this->car;
    }

    public abstract function buildMultimedia();
    public abstract function buildWheels();
    public abstract function buildEngine();
    public abstract function buildFrames();
    public abstract function buildLuxury();
    public abstract function buildSafety();
}

class VolkswagenBuilder extends CarBuilderBase
{
    public function buildMultimedia()
    {
        $this->car->multimedia = 'VW RNS 510';
    }

    public function buildWheels()
    {
        $this->car->wheels = '17/ VW Wheel';
    }

    public function buildEngine()
    {
        $this->car->engine = '1.8 TSI';
    }

    public function buildFrames()
    {
        $this->car->frame = 'VW frame';
    }

    public function buildLuxury()
    {
        $this->car->luxury = 'VW R-style';
    }

    public function buildSafety()
    {
        $this->car->safety = 'VW Lane Assist';
    }
}

class AudiBuilder extends CarBuilderBase
{
    public function buildMultimedia()
    {
        $this->car->multimedia = 'Audi MMI Multimedia';
    }

    public function buildWheels()
    {
        $this->car->wheels = '18/ Audi Wheel';
    }

    public function buildEngine()
    {
        $this->car->engine = '2.0 TFSI';
    }

    public function buildFrames()
    {
        $this->car->frame = 'Audi frame';
    }

    public function buildLuxury()
    {
        $this->car->luxury = 'Audi Exclusive Interior';
    }

    public function buildSafety()
    {
        $this->car->safety = 'Side Assist';
    }
}

abstract class CarFactoryBase
{
    protected $carBuilderBase;

    function __construct($builder)
    {
        $this->carBuilderBase = $builder;
    }

    public abstract function construct();
}

class CheapCarFactory extends CarFactoryBase
{
    public function construct()
    {
        $this->carBuilderBase->buildFrames();
        $this->carBuilderBase->buildEngine();
        $this->carBuilderBase->buildWheels();
        $this->carBuilderBase->buildSafety();

        return $this->carBuilderBase->getCar();
    }
} 
 
class LuxuryCarFactory extends CarFactoryBase
{
    public function construct()
    {
        $this->carBuilderBase->buildFrames();
        $this->carBuilderBase->buildEngine();
        $this->carBuilderBase->buildWheels();
        $this->carBuilderBase->buildSafety();
        $this->carBuilderBase->buildMultimedia();
        $this->carBuilderBase->buildLuxury();

        return $this->carBuilderBase->getCar();
    }
}


echo 'Cheap Volkswagen:';
echo '<br />';
$constructor = new CheapCarFactory(new VolkswagenBuilder(new Car()));
$car = $constructor->construct();
echo (string)($car);
echo '<br />';

echo 'Luxury Volkswagen:';
echo '<br />';
$constructor = new LuxuryCarFactory(new VolkswagenBuilder(new Car()));
$car = $constructor->construct();
echo (string)($car);
echo '<br />';

echo 'Cheap Audi:';
echo '<br />';
$constructor = new CheapCarFactory(new AudiBuilder(new Car()));
$car = $constructor->construct();
echo (string)($car);
echo '<br />';

echo 'Luxury Audi:';
echo '<br />';
$constructor = new LuxuryCarFactory(new AudiBuilder(new Car()));
$car = $constructor->construct();
echo (string)($car);