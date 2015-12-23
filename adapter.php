<?php
/**
 * 04:26
 */
/**
 * adapter.php
 * Реализация паттерна Адаптер
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     Mediasite LLC
 * @link        http://www.mediasite.ru/
 */

interface IHomeCat
{
    function meow();
    function scratch();
}

class PedigreedCat implements IHomeCat
{
    public $name;

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

    public function meow()
    {
        echo 'Мяу мяу!';
    }

    public function scratch()
    {
        echo 'Я царапаюсь, но не сильно';
    }
}

class PrintCatInfo
{
    public function printCatInfo($cat)
    {
        echo 'Кошачье досье: ';
        echo '<br />';
        echo 'Имя кота: ';
        echo $cat->name;
        echo 'Вид мяуканья: ';
        $cat->meow();
        echo '<br />';
        echo 'Вид царапанья: ';
        $cat->scratch();
        echo '<br />';
    }
}

