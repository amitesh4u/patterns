<?php
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

define( 'STATE_ON', 1 );
define( 'STATE_OFF', 0 );

class Light
{
    public $state;

    public function turnOn()
    {
        echo 'Свет включен';
        $this->state = STATE_ON;
    }

    public function turnOff()
    {
        echo 'Свет выключен';
        $this->state = STATE_OFF;
    }
}

class Misic
{
    public $state;

    public function turnOn()
    {
        echo 'Музыка включена';
        $this->state = STATE_ON;
    }

    public function turnOff()
    {
        echo 'Музыка выключена';
        $this->state = STATE_OFF;
    }
}

class Teapot
{
    public $state;

    public function turnOn()
    {
        echo 'Чайник включен';
        $this->state = STATE_ON;
    }

    public function turnOff()
    {
        echo 'Чайник выключен';
        $this->state = STATE_OFF;
    }
}

class Tv
{
    public $state;

    public function turnOn()
    {
        echo 'Телевизор включен';
        $this->state = STATE_ON;
    }

    public function turnOff()
    {
        echo 'Телевизор выключен';
        $this->state = STATE_OFF;
    }
}

interface ICommand
{
    function execute();
    function undo();
}

class LightsCommand implements ICommand
{
    private $light;

    function __construct($light)
    {
        $this->light = $light;
    }

    public function execute()
    {
        $this->light->turnOn();
    }

    public function undo()
    {
        $this->light->turnOff();
    }

    public function __toString()
    {
        return 'Включить свет';
    }
}

class TvCommand implements ICommand
{
    private $tv;

    function __construct($tv)
    {
        $this->tv = $tv;
    }

    public function execute()
    {
        $this->tv->turnOn();
    }

    public function undo()
    {
        $this->tv->turnOff();
    }

    public function __toString()
    {
        return 'Включить телевизор';
    }
}

class MusicCommand implements ICommand
{
    private $music;

    function __construct($music)
    {
        $this->music = $music;
    }

    public function execute()
    {
        $this->music->turnOn();
    }

    public function undo()
    {
        $this->music->turnOff();
    }

    public function __toString()
    {
        return 'Включить музыку';
    }
}

class TeapotCommand implements ICommand
{
    private $teapot;

    function __construct($teapot)
    {
        $this->teapot = $teapot;
    }

    public function execute()
    {
        $this->teapot->turnOn();
    }

    public function undo()
    {
        $this->teapot->turnOff();
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

    public function pushButton($input)
    {
        if (isset($this->commands[$input])) {
            $this->commands[$input]->execute();
        }
    }

    public function undoButton($input)
    {
        if (isset($this->commands[$input])) {
            $this->commands[$input]->undo();
        }
    }

    public function setCommandForButton($buttonId, $cmd)
    {
        $this->commands[$buttonId] = $cmd;
    }

    public function __toString()
    {
        $str = 'Выберете вариант ниже:' . '<br />';

        foreach ($this->commands as $key => $command) {
            $str = $str . $key . ' - ' . (string)$command . '<br />';
        }

        return $str;
    }
}

$control = new RemoteControl();
$control->setCommandForButton('1', new LightsCommand(new Light()));
$control->setCommandForButton('2', new TvCommand(new Tv()));
$control->setCommandForButton('3', new MusicCommand(new Misic()));
$control->setCommandForButton('4', new TeapotCommand(new Teapot()));

echo (string)$control;
echo '<br />';
echo '<br />';
$control->pushButton('4');
echo '<br />';
$control->undoButton('4');