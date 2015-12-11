<?php
/**
 * 29:00
 */
/**
 * decorator.php
 * Реализация паттерна Декоратор
 *
 * Принципы проектирования:
 * Классы должны быть открыты к расширению и закрыты для изменений
 * Стремиться к тому, чтобы классы могли "обрастать" поведением без изменения кода
 * Но без фанатизма
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

class MilkCondiment extends CondimentsDecoratorBase
{
    public function getCost()
    {

    }
}

class SugarCondiment extends CondimentsDecoratorBase
{
    public function getCost()
    {

    }
}

class ChocolateCondiment extends CondimentsDecoratorBase
{
    public function getCost()
    {

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

class Capuccino extends BeverageBase
{
    function __construct()
    {
        $this->description = 'Coffee with steamed milk';
    }

    public function getCost()
    {
        return 200;
    }
}

class HotChocolate extends BeverageBase
{
    function __construct()
    {
        $this->description = 'Sweet hot chocolate';
    }

    public function getCost()
    {
        return 200;
    }
}

$beverages = [
    new Capuccino(),
    new BlackTea(),
    new Espresso(),
    new HotChocolate()
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