<?php
/**
 * 25:02
 */
/**
 * command.php
 * Реализация паттерна Команда
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

    public function _toString()
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

    public function _toString()
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

    public function _toString()
    {
        return 'Включить свет';
    }
}

class RemoteControl
{
    private $commands;

    function __construct()
    {
        $this->commands['1'] = new LightsCommand();
        $this->commands['2'] = new TvCommand();
        $this->commands['3'] = new MusicCommand();
    }

    public function drawMenu()
    {
        echo 'Выберете вариант ниже:' . '<br />';
        echo '1 - Включить свет' . '<br />';
        echo '1off - выключить свет' . '<br />';
        echo '2 - Включить телевизор' . '<br />';
        echo '2off - Выключить телевизор' . '<br />';
        echo '3 Включить музыку' . '<br />';
        echo '3off - Выключить музыку' . '<br />';
        echo '0 - Выход' . '<br />';
    }

    public function performAction($input)
    {
        echo 'Ваш выбор: ' . $input . '<br />';

        switch ($input) {
            case '2':
                $this->turnLightOff();
                break;
            case '4':
                $this->turnMusicOff();
                break;
            case '6':
                $this->turnTvOff();
                break;
        }

        if (isset($this->commands[$input])) {
            $this->commands[$input]->execute();
        }
    }

    public function setCommandForButton($buttonId, $cmd)
    {
        $this->commands[$buttonId] = $cmd;
    }


    private function turnLightOff()
    {
        echo 'Свет выключен';
    }

    private function turnMusicOff()
    {
        echo 'Музыка выключена';
    }

    private function turnTvOff()
    {
        echo 'Телевизор выключен';
    }
}

$control = new RemoteControl();

$control->drawMenu();
echo '<br />';
echo '<br />';
$control->performAction('1');
