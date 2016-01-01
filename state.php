<?php
/**
 * state.php
 * Реализация паттерна Состояние
 * 
 * Паттерн Состояние применяется, если во время
 * выполнения программы объекту необходимо
 * менять свое поведение в зависимости от состояния
 *
 * Выносим поведение а отдельную иерархию классов
 * Реализуем поведение для каждого возможного состояния
 * Делегируем выполнение поведения классам - состояниям
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     Mediasite LLC
 * @link        http://www.mediasite.ru/
 */

interface IState
{
    function fillTank();
	function turnKey();
	function drive();
    function stop();
}

class EmptyTankState implements IState
{
	private $car;
	
	function __construct($car)
    {
        $this->car = $car;
    }
	
	public function fillTank()
	{
		$this->car->gasoline = 70;
        echo 'Теперь бак полный';
		$this->car->setState($this->car->fullTankState);
	}
	
	public function turnKey()
	{
		echo 'Без бензина не работаю';
	}
	
	public function drive()
	{
		echo 'И как мы поедем без бензина? Никак!';
	}
	
    public function stop()
	{
		echo 'Нет бензина - значит и так стоим';
	}
}

class FullTankState implements IState
{
	private $car;
	
	function __construct($car)
    {
        $this->car = $car;
    }
	
	public function fillTank()
	{
        echo 'В меня столько не влезет';
	}
	
	public function turnKey()
	{
		echo 'Дрын дын дын дын трррррр';
		$this->car->setState($this->car->engineStartedState);
	}
	
	public function drive()
	{
		echo 'Сначала заведи меня';
	}
	
    public function stop()
	{
		echo 'Я и так стою';
	}
}

class EngineStartedState implements IState
{
	private $car;
	
	function __construct($car)
    {
        $this->car = $car;
    }
	
	public function fillTank()
	{
        echo 'Нельзя заправляться с работающим двигателем';
	}
	
	public function turnKey()
	{
		echo 'Тссссс Передышка';
		$this->car->setState($this->car->fullTankState);
	}
	
	public function drive()
	{
		$this->tryDrive();
	}
	
    public function stop()
	{
		echo 'Я и так стою';
	}
	
	private function tryDrive()
    {
	    if ($this->car->gasoline > 0) {
			echo 'Поехали!';
			$this->car->setState($this->car->drivingState);
			$this->car->gasoline -= 10;
		} else {
			echo 'Бензин кончился!';
			$this->car->setState($this->car->emptyTankState);
		}
    }
}

class DrivingState implements IState
{
	private $car;
	
	function __construct($car)
    {
        $this->car = $car;
    }
	
	public function fillTank()
	{
        echo 'Нельзя заправляться на ходу';
	}
	
	public function turnKey()
	{
		echo 'На ходу ключ не трогать!';
	}
	
	public function drive()
	{
		$this->tryDrive();
	}
	
    public function stop()
	{
		echo 'Накатался? Ну все постоим ...';
		$this->car->setState($this->car->engineStartedState);
	}
	
	private function tryDrive()
    {
	    if ($this->car->gasoline > 0) {
			echo 'Поехали!';
		} else {
			echo 'Бензин кончился!';
			$this->car->setState($this->car->emptyTankState);
		}
    }
}

class Car
{
	private $currentState;
    public  $gasoline;
	public  $emptyTankState;
	public  $fullTankState;
	public  $engineStartedState;
	public  $drivingState;
	
	function __construct()
    {
		$this->emptyTankState = new EmptyTankState($this);
		$this->fullTankState = new FullTankState($this);
		$this->engineStartedState = new EngineStartedState($this);
		$this->drivingState = new DrivingState($this);
		
		$this->currentState = $this->emptyTankState;
		$this->gasoline = 0;
	}
    
    public function fillTank()
    {
		$this->gasoline = 70;
		$this->currentState->fillTank();
    }

    public function turnKey()
    {
		$this->currentState->turnKey();
    }

    public function drive()
    {
		$this->currentState->drive();
		$this->gasoline -= 10;
    }

    public function stop()
    {
		$this->currentState->stop();
    }
	
	public function setState($state)
	{
		$this->currentState = $state;
	}
}

$car = new Car();
$car->fillTank();
echo '<br />';
$car->turnKey();
echo '<br />';
$car->turnKey();
echo '<br />';
$car->turnKey();
echo '<br />';
$car->drive();
echo '<br />';
$car->stop();
echo '<br />';