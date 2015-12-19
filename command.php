<?php
/**
 *
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





class RemoteControl
{
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
            case '1':
                $this->turnLightOn();
                break;
            case '2':
                $this->turnLightOff();
                break;
            case '3':
                $this->turnMusicOn();
                break;
            case '4':
                $this->turnMusicOff();
                break;
            case '5':
                $this->turnTvOn();
                break;
            case '6':
                $this->turnTvOff();
                break;
        }
    }

    private function turnLightOn()
    {
        echo 'Свет включен';
    }

    private function turnLightOff()
    {
        echo 'Свет выключен';
    }

    private function turnMusicOn()
    {
        echo 'Музыка включена';
    }

    private function turnMusicOff()
    {
        echo 'Музыка выключена';
    }

    private function turnTvOn()
    {
        echo 'Телевизор включен';
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
$control->performAction('2');
