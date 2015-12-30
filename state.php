<?php
/**
 * 05:00
 */
/**
 * state.php
 * Реализация паттерна Состояние
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     Mediasite LLC
 * @link        http://www.mediasite.ru/
 */

define('EMPTY_TANK', 'EMPTY_TANK');
define('FULL_TANK', 'FULL_TANK');
define('ENGINE_STARTED', 'ENGINE_STARTED');
define('DRIVING', 'DRIVING');

class Car
{
    private $gasoline = 0;
    private $state = EMPTY_TANK;

    public function fillTank()
    {
        if ($this->state === EMPTY_TANK) {
            $this->gasoline = 70;
            $this->state = FULL_TANK;
            echo 'Теперь бак полный';
        } elseif ($this->state === ENGINE_STARTED) {
            echo 'Нельзя заправляться с работающим двигателем';
        } elseif ($this->state === DRIVING) {
            echo 'Нельзя заправлять на ходу';
        } elseif ($this->state === FULL_TANK) {
            echo 'В меня столько не влезет';
        }
    }

    public function turnKey()
    {
        if ($this->state === EMPTY_TANK) {
            $this->gasoline = 70;
            $this->state = FULL_TANK;
            echo 'Теперь бак полный';
        } elseif ($this->state === ENGINE_STARTED) {
            echo 'Нельзя заправляться с работающим двигателем';
        } elseif ($this->state === DRIVING) {
            echo 'Нельзя заправлять на ходу';
        } elseif ($this->state === FULL_TANK) {
            echo 'В меня столько не влезет';
        }
    }

    public function drive()
    {

    }

    public function stop()
    {

    }

    private function tryDrive()
    {

    }
}