<?php
/**
 * stategy.php
 * Реализация паттерна стратегия
 *
 * Паттерн стратегия определяет семейство алгоритмов,
 * инкапсулирует каждый из них и
 * обеспечивает взаимозаменяемость
 *
 * Принципы проектирования:
 * отделить постоянные части программы от изменяемых
 * отдавать части программы от изменяемых
 * отдавать предпочтение композиции нежели наследованию
 * программировать на уровне интерфейса, а не реализации
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     Mediasite
 * @link        http://www.mediasite.ru/
 */

/**
 * Для решения проблемы с резиновыми и деревянными утками
 * сделаем методы виртуальными, чтобы их можно было переопределять!
 * В php все методы по умолчанию виртуальные.
 * Проблема: в наследуемых классах много мусорного кода от переопределения
 * Решение: создание отдельных интерфейсов под каждое действие
 *
 * Изменения - это главный враг архитектуры! Ребята! Ваша программа не гибкая!
 *
 * В следующией итерации, до нас доходит, что нужно разделить действия на:
 * Постоянные части и
 * Переменные части
 */

/**
 * Определим интерфейсы переменных действий
 */

/**
 * Interface IFlyable
 */
interface IFlyable
{
    public function fly();
}

/**
 * Interface IQuackable
 */
interface IQuackable
{
    public function quack();
}

/**
 * Определяем возможные реализации этих интерфейсав (конструктор)
 */

/**
 * Class SimpleQuak
 */
class SimpleQuak implements IQuackable
{
    public function quack()
    {
        echo 'Quack! Quack!';
    }
}

/**
 * Class FlyWithWings
 */
class FlyWithWings implements IFlyable
{
    public function fly()
    {
        echo 'I am flying';
    }
}

/**
 * Class NoFly
 */
class NoFly implements IFlyable
{
    public function fly()
    {
    }
}

/**
 * Class NoQuak
 */
class NoQuak implements IQuackable
{
    public function quack()
    {
    }
}

/**
 * Class DuckBase
 * Базовый абстрактный класс
 */
abstract class DuckBase implements IFlyable, IQuackable
{
    /**
     * Определим переменные в базовам классе, которые можно будет
     * изменять на нужную реализацию
     */
    /** @class */
    protected $quakBehavior;
    /** @class */
    protected $flyBehaviour;

    /**
     * @param class $newQuakBehavior
     * класс для быстрой установки переменного значений
     */
    public function setQuakBehavior($newQuakBehavior)
    {
        $this->quakBehavior = $newQuakBehavior;
    }

    /**
     * @param class $newFlyBehaviour
     * класс для быстрой установки переменного значений
     */
    public function setFlyBehavior($newFlyBehaviour)
    {
        $this->flyBehaviour = $newFlyBehaviour;
    }

    /**
     * Класс будет реагировать в зависимости от определенной реализации
     */
    public function quack()
    {
        if ($this->quakBehavior !== null) {
            $this->quakBehavior->quack();
        }
    }

    /**
     * Класс будет реагировать в зависимости от определенной реализации
     */
    public function fly()
    {
        if ($this->flyBehaviour !== null) {
            $this->flyBehaviour->fly();
        }
    }

    /**
     * Класс для всех объектов одинаков
     */
    public function swim()
    {
        echo 'I am swimming';
    }

    /**
     * Класс для каждого будет индивидуален
     */
    public abstract function display();
}

/**
 * Определяем список классов с нужными нам действиями
 */

/**
 * Class ExoticDuck
 */
class ExoticDuck extends DuckBase
{
    function __construct()
    {
        $this->quakBehavior = new SimpleQuak();
        $this->flyBehaviour = new FlyWithWings();
    }

    public function display()
    {
        echo 'I am exotic duck, men';
    }
}

/**
 * Class SimpleDuck
 */
class SimpleDuck extends DuckBase
{
    function __construct()
    {
        $this->quakBehavior = new SimpleQuak();
        $this->flyBehaviour = new FlyWithWings();
    }

    public function display()
    {
        echo 'I am simple duck, men';
    }
}

/**
 * Class WoodenDuck
 */
class WoodenDuck extends DuckBase
{
    function __construct()
    {
        $this->quakBehavior = new NoQuak();
        $this->flyBehaviour = new NoFly();
    }

    public function display()
    {
        echo 'I am wooden duck';
    }
}

/**
 * Class RubberDuck
 */
class RubberDuck extends DuckBase
{
    function __construct()
    {
        $this->quakBehavior = new SimpleQuak();
        $this->flyBehaviour = new NoFly();
    }

    public function display()
    {
        echo 'I am rubber duck';
    }
}

/**
 * Class UpgradableDuck
 */
class UpgradableDuck extends DuckBase
{
    public function display()
    {
        echo 'I am upgradable duck';
    }
}

$ducks = [
    new ExoticDuck(),
    new SimpleDuck(),
    new WoodenDuck(),
    new RubberDuck(),
    new UpgradableDuck()
];

/**
 * Внимание! У каждого класса мы можем вызвать все методы!
 */
foreach ($ducks as $duck) {
    echo $duck->quack() . '<br />' ;
    echo $duck->swim(). '<br />' ;
    echo $duck->display(). '<br />' ;
    echo $duck->fly(). '<br />' ;
    echo '<br />';
}