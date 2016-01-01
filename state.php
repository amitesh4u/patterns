<?php
/**
 * 16:17
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
			$this->car->gasoline -= 10;
		} else {
			echo 'Бензин кончился!';
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
	}
	
	private function tryDrive()
    {
	    if ($this->car->gasoline > 0) {
			echo 'Поехали!';
			$this->car->gasoline -= 10;
		} else {
			echo 'Бензин кончился!';
		}
    }
}















class Car
{
    public $gasoline;
	public $emptyTankState;
	public $fullTankState;
	public $engineStartedState;
	public $drivingState;
	
	function __construct()
    {
		$this->emptyTankState = new EmptyTankState($this);
		$this->fullTankState = new FullTankState($this);
		$this->engineStartedState = new EngineStartedState($this);
		$this->drivingState = new DrivingState($this);
	}
    

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
			echo 'Без бензина не работаю';
        } elseif ($this->state === ENGINE_STARTED) {
			$this->state = FULL_TANK;
            echo 'Тсссс. Передышка.';
        } elseif ($this->state === DRIVING) {
            echo 'На ходу ключ не трогать';
        } elseif ($this->state === FULL_TANK) {
			$this->state = ENGINE_STARTED;
            echo 'Дрын дын дын дын трррррр';
        }
    }

    public function drive()
    {
		if ($this->state === EMPTY_TANK) {
			echo 'И как мы поедем без бензина? Никак!';
        } elseif ($this->state === ENGINE_STARTED) {
			$this->state = DRIVING;
			$this->tryDrive();
        } elseif ($this->state === DRIVING) {
            $this->tryDrive();
        } elseif ($this->state === FULL_TANK) {
            echo 'Сначала заведи меня';
        }
    }

    public function stop()
    {
		if ($this->state === EMPTY_TANK) {
			echo 'Нет бензина - значит и так стоим';
        } elseif ($this->state === ENGINE_STARTED) {
			echo 'Я и так стою';
        } elseif ($this->state === DRIVING) {
            $this->state = ENGINE_STARTED;
			echo 'Накатался? Ну постоим ... ';
        } elseif ($this->state === FULL_TANK) {
            echo 'Я и так стою';
        }
    }

    private function tryDrive()
    {
	    if ($this->gasoline > 0) {
			echo 'Поехали!';
			$this->gasoline -= 10;
		} else {
			echo 'Бензин кончился!';
			$this->state = EMPTY_TANK;
		}
    }
}

$car = new Car();
$car->fillTank();
echo '<br />';
$car->drive();
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
