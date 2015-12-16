<?php
/**
 * decorator.php
 * Реализация паттерна Декоратор
 *
 * Принципы проектирования:
 * Классы должны быть открыты к расширению и закрыты для изменений
 * Стремиться к тому, чтобы классы могли "обрастать" поведением без изменения кода
 * Но без фанатизма
 *
 * Наследуем интерфейс, а не поведение.
 * Композиция - для расширения поведения.
 * Композиция дает свободу в режиме выполнения
 * Свобода во время выполнения программы. Составление на лету.
 * Вместо абстрактного класса может быть интерфейс - все зависит от исходной структуры.
 * Не использовать проверку на типы.
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     Mediasite
 * @link        http://www.mediasite.ru/
 */

/**
 * Class BeverageBase
 * Базовый класс напитка
 */
abstract class BeverageBase
{
    protected $description = '';

    public function getDescription()
    {
        return $this->description;
    }

    public function getCost()
    {
        return 0;
    }
}

abstract class CondimentsDecoratorBase extends BeverageBase
{

}

/**
 * Class MilkCondiment
 * Класс расширяет функциональность
 */
class MilkCondiment extends CondimentsDecoratorBase
{
    private $beverage;

    function __construct($beverage)
    {
        $this->beverage = $beverage;
        $this->description = $this->beverage->getDescription() . ' + Milk';
    }

    public function getCost()
    {
        return $this->beverage->getCost() + 50;
    }
}

class SugarCondiment extends CondimentsDecoratorBase
{
    private $beverage;

    function __construct($beverage)
    {
        $this->beverage = $beverage;
        $this->description = $this->beverage->getDescription() . ' + Sugar';
    }

    public function getCost()
    {
        return $this->beverage->getCost() + 10;
    }
}

class ChocolateCondiment extends CondimentsDecoratorBase
{
    private $beverage;

    function __construct($beverage)
    {
        $this->beverage = $beverage;
        $this->description = $this->beverage->getDescription() . ' + Chocolate';
    }

    public function getCost()
    {
        return $this->beverage->getCost() + 70;
    }
}



class Espresso extends BeverageBase
{
    function __construct()
    {
        $this->description = 'Small portion of strong coffee';
    }

    public function getCost()
    {
        return 150;
    }
}

class BlackTea extends BeverageBase
{
    function __construct()
    {
        $this->description = 'Black tea from teabag';
    }

    public function getCost()
    {
        return 25;
    }
}

class GreenTea extends BeverageBase
{
    function __construct()
    {
        $this->description = 'Green leaf tea';
    }

    public function getCost()
    {
        return 125;
    }
}

$beverages = [
    new BlackTea(),
    new Espresso(),
    new GreenTea(),
    new SugarCondiment(new MilkCondiment(new Espresso())),
    new SugarCondiment(new GreenTea())
];

/**
 * Внимание! У каждого класса мы можем вызвать все методы!
 */
foreach ($beverages as $beverage) {
    echo $beverage->getDescription() . '<br />' ;
    echo $beverage->getCost() . '<br />' ;
    echo '<br />';
}

/**
 * Проблема в том, что возникнет большое количество классов напитков, с которыми
 * трудно будет работать и при этом много параметров (сахар, шоколад),
 * от которых будет изменяться цена
 */