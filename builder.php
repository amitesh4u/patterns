<?php
/**
 * builder.php
 * Реализация паттерна Строитель
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     Mediasite LLC
 * @link        http://www.mediasite.ru/
 */
 
 // 04:33
abstract class CarBuilderBase
{
	protected $carBuilder;
	
	function __construct($builder)
	{
		$this->carBuilder = $builder;
	}
	
	public abstract function construct();
}
 
class CheapCarFactory extends CarBuilderBase
{
	public function construct()
	{
		
	}
} 
 
class LuxuryCarFactory extends CarBuilderBase
{
	public function construct()
	{
		
	}
} 
 
 
 
class Car 
{
	public $engine;
	public $frame;
	public $wheels;
	public $luxury;
	public $multimedia;
	public $safety;
	
	public function __toString()
	{
		$str = '';
		$str = $str . 'Engine:     ' . $this->engine . '<br />';
		$str = $str . 'Frame:      ' . $this->frame . '<br />';
		$str = $str . 'Wheels:     ' . $this->wheels . '<br />';
		$str = $str . 'Luxury:     ' . $this->luxury . '<br />';
		$str = $str . 'Multimedia: ' . $this->multimedia . '<br />';
		$str = $str . 'Safety:     ' . $this->safety . '<br />';
		
		return $str;
	}
}
 
echo (string)(new Car);