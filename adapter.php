<?php
/**
 * adapter.php
 * Реализация паттерна Адаптер
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     Mediasite LLC
 * @link        http://www.mediasite.ru/
 */

/**
 * Interface IWildCat
 * Набор классов для диких кошек
 */
interface IWildCat
{
    function growl();
    function scratch();
}

class Tiger implements IWildCat
{
    public $breed = 'Тигр обыкновенный';

    function __construct()
    {
    }

    public function growl()
    {
        echo 'Грррррррр';
    }

    public function scratch()
    {
        echo 'У меня очень острые когти, царапаюсь до смерти';
    }
}

/**
 * Interface IHomeCat
 * Набор классов для домашних кошек
 */
interface IHomeCat
{
    function meow();
    function scratch();
}

class PedigreedCat implements IHomeCat
{
    public $name;

    function __construct($name)
    {
        $this->name = $name;
    }

    public function meow()
    {
        echo 'Урррр урррр';
    }

    public function scratch()
    {
        echo 'Я не царапаюсь';
    }
}

class YardCat implements IHomeCat
{
    public $name;

    function __construct($name)
    {
        $this->name = $name;
    }

    public function meow()
    {
        echo 'Мяу мяу!';
    }

    public function scratch()
    {
        echo 'Я царапаюсь, но не сильно';
    }
}

/**
 * Class PrintCatInfo
 * Печать информации о домашних кошках
 */
class PrintCatInfo
{
    public function printCat($cat)
    {
        echo 'Кошачье досье: ';
        echo '<br />';
        echo 'Имя кота: ';
        echo $cat->name;
        echo '<br />';
        echo 'Вид мяуканья: ';
        $cat->meow();
        echo '<br />';
        echo 'Вид царапанья: ';
        $cat->scratch();
        echo '<br />';
    }
}

/**
 * Class HomeCatAdapter
 * Адаптер для привода диких кошек к стандарту домашних,
 * чтобы можно было осуществить вывод через PrintCatInfo
 */
class HomeCatAdapter implements IHomeCat
{
    private $wildCat;
    public $name;

    function __construct($wildCat)
    {
        $this->wildCat = $wildCat;
        $this->name = $wildCat->breed;
    }

    public function meow()
    {
        $this->wildCat->growl();
    }

    public function scratch()
    {
        $this->wildCat->scratch();
    }
}

$print = new PrintCatInfo();

$print->printCat(new YardCat('Вася'));
echo '<br />';
$print->printCat(new PedigreedCat('Барсик'));
echo '<br />';
$print->printCat(new HomeCatAdapter(new Tiger()));
echo '<br />';


/**
 * Interface ISuperHero
 * Пример адаптирования нескольких разных классов к одному
 */
interface ISuperHero
{
    function shoot();
    function fly();
    function goThrougWalls();
}

interface IFly
{
    function fly();
}

interface IShoot
{
    function shoot();
}

interface IWalls
{
    function goThrougWalls();
}

class SuperHeroAdapter implements ISuperHero
{
    private $fly;
    private $shoot;
    private $goThrougWalls;

    function __construct($fly, $shoot, $goThrougWalls)
    {
        $this->fly = $fly;
        $this->shoot = $shoot;
        $this->goThrougWalls = $goThrougWalls;
    }

    public function shoot()
    {
        $this->shoot->shoot();
    }

    public function fly()
    {
        $this->fly->fly();
    }

    public function goThrougWalls()
    {
        $this->goThrougWalls->goThrougWalls();
    }
}