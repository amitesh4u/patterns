<?php
/**
 *
 */
/**
 * templateMethod.php
 * Реализация паттерна "Шаблонный метод"
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     Mediasite LLC
 * @link        http://www.mediasite.ru/
 */

class FastFood
{
    public function roastBread()
    {
        echo 'Bread';
    }

    public function putVegetables()
    {
        echo 'Vegetables';
    }

    public abstract function prepare();
}

class Hamburger extends FastFood
{
    private function putVegetables()
    {
        echo 'Vegetables';
    }

    private function fryMeat()
    {
        echo 'Meat';
    }

    private function addKetchup()
    {
        echo 'Ketchup';
    }

    private function roastBread()
    {
        echo 'Bread';
    }

    public function prepare()
    {
        $this->roastBread();
        echo '<br />';
        $this->fryMeat();
        echo '<br />';
        $this->putVegetables();
        echo '<br />';
        $this->addKetchup();
        echo '<br />';
    }
}

class HotDog extends FastFood
{
    public function prepare()
    {
        /*
        $this->roastBread();
        echo '<br />';
        $this->fryMeat();
        echo '<br />';
        $this->putVegetables();
        echo '<br />';
        $this->addKetchup();
        echo '<br />';
        */
    }
}