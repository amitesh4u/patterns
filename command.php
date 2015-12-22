<?php
/**
 * 39:02
 */
/**
 * command.php
 * Реализация паттерна Команда
 *
 * Паттерн Команда инкапсулирует запрос в виде объекта,
 * позволяя параметризировать клиентские
 * запросы другими объектами,
 * с возможностью отмены операции и
 * поддержкой состояния
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     Mediasite LLC
 * @link        http://www.mediasite.ru/
 */

interface ICommand
{
    function execute();
}

class LightsCommand implements ICommand
{
    public function execute()
    {
        echo 'Свет включен';
    }

    public function __toString()
    {
        return 'Включить свет';
    }
}

class TvCommand implements ICommand
{
    public function execute()
    {
        echo 'Телевизор включен';
    }

    public function __toString()
    {
        return 'Включить телевизор';
    }
}

class MusicCommand implements ICommand
{
    public function execute()
    {
        echo 'Музыка включена';
    }

    public function __toString()
    {
        return 'Включить музыку';
    }
}

class TeapotCommand implements ICommand
{
    public function execute()
    {
        echo 'Чайник включен';
    }

    public function __toString()
    {
        return 'Включить чайник';
    }
}


class RemoteControl
{
    private $commands;

    function __construct()
    {
    }

    public function drawMenu()
    {
        echo 'Выберете вариант ниже:' . '<br />';

        foreach ($this->commands as $key => $command) {
            echo $key . ' - ' . (string)$command;
            echo '<br />';
        }
    }

    public function performAction($input)
    {
        echo 'Ваш выбор: ' . $input . '<br />';

        if (isset($this->commands[$input])) {
            $this->commands[$input]->execute();
        }
    }

    public function setCommandForButton($buttonId, $cmd)
    {
        $this->commands[$buttonId] = $cmd;
    }
}

$control = new RemoteControl();
$control->setCommandForButton('1', new LightsCommand());
$control->setCommandForButton('2', new TvCommand());
$control->setCommandForButton('3', new MusicCommand());
$control->setCommandForButton('4', new TeapotCommand());

$control->drawMenu();
echo '<br />';
echo '<br />';
$control->performAction('4');