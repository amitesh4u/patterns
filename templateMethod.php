<?php
/**
 * templateMethod.php
 * Реализация паттерна "Шаблонный метод"
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     Mediasite LLC
 * @link        http://www.mediasite.ru/
 */

abstract class FastFood
{
    public abstract function prepareMainIngredient();

    public abstract function addTopings();

    public function roastBread()
    {
        echo 'Bread';
    }

    public function putVegetables()
    {
        echo 'Vegetables';
    }

    public function customerWantsTopings()
    {
        return true;
    }

    /**
     * Это и есть шаблонный метод
     * он будет присутствовать во всех
     * классах и не изменяться
     */
    public function prepare()
    {
        $this->roastBread();
        echo '<br />';
        $this->prepareMainIngredient();
        echo '<br />';
        $this->putVegetables();
        echo '<br />';

        if ($this->customerWantsTopings()) {
            $this->addTopings();
        }
        echo '<br />';

    }
}

class Hamburger extends FastFood
{
    public function prepareMainIngredient()
    {
        echo 'Meat';
    }

    public function addTopings()
    {
        echo 'Ketchup';
    }
}

class HotDog extends FastFood
{
    public function customerWantsTopings()
    {
        return false;
    }

    public function prepareMainIngredient()
    {
        echo 'Sausage';
    }

    public function addTopings()
    {
        echo 'Mustard';
    }
}

(new Hamburger())->prepare();
echo '<br />';
(new HotDog())->prepare();