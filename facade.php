<?php
/**
 * facade.php
 * Реализация паттерна Фасад
 *
 * Суть Фасада в том чтобы собрать рутинный вызов однотипных методов в один метод
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     Mediasite LLC
 * @link        http://www.mediasite.ru/
 */

class WaterManagingSubsystem
{
    public function fillWater($litres)
    {
        echo 'Fill with ' . $litres . ' litres of water';
    }

    public function emptyWater()
    {
        echo 'Empty water tank';
    }
}

class Thermo
{
    public function warmUp($degrees)
    {
        echo 'Warm for ' . $degrees . ' degrees';
    }
}

class Engine
{
    public function rotate()
    {
        echo 'Start rotating';
    }

    public function stop()
    {
        echo 'Stop rotating';
    }
}

class Dryer
{
    public function dry($seconds, $intensity)
    {
        echo 'Drying ' . $seconds . ' seconds with intensity ' . $intensity;
    }
}

class WashingMachine
{
    private $drier;
    private $engine;
    private $thermo;
    private $water;

    function __construct($drier, $engine, $thermo, $water)
    {
        $this->drier = $drier;
        $this->engine = $engine;
        $this->thermo = $thermo;
        $this->water = $water;
    }

    public function washCotton()
    {
        $this->water->fillWater(10);
        echo '<br />';
        $this->thermo->warmUp(70);
        echo '<br />';
        $this->engine->rotate();
        echo '<br />';
        $this->engine->rotate();
        echo '<br />';
        $this->engine->rotate();
        echo '<br />';
        $this->engine->stop();
        echo '<br />';
        // И ещё много однотипной работы
    }

    public function washWool()
    {
        $this->water->fillWater(7);
        echo '<br />';
        $this->thermo->warmUp(50);
        echo '<br />';
        $this->engine->rotate();
        echo '<br />';
        $this->engine->rotate();
        echo '<br />';
        $this->engine->rotate();
        echo '<br />';
        $this->engine->stop();
        echo '<br />';
        // И ещё много однотипной работы
    }
}

$water = new WaterManagingSubsystem();
$thermo = new Thermo();
$engine = new Engine();
$dryer = new Dryer();

$washingMachine = new WashingMachine($dryer, $engine, $thermo, $water);
$washingMachine->washCotton();
echo '<br />';
$washingMachine->washWool();
echo '<br />';