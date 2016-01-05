<?php
/**
 * observer.php
 * Реализация паттерна Наблюдатель
 *
 * Наблюдатель определяет отношение один-ко-многим
 * между объектами, позволяя при этом оповещать
 * зависимые объекты наблюдателей об изменениях в оюъекте субъекта
 *
 * @author      Pereskokov Yurii
 * @copyright   2015 Pereskokov Yurii
 * @license     Mediasite
 * @link        http://www.mediasite.ru/
 */

interface IObserver
{
    function update($twitter, $lenta, $tv);
    function display();
}

class LentaWidget implements IObserver
{
    private $lenta;

    function __construct($subject)
    {
        $subject->registerObserver($this);
    }

    public function update($twitter, $lenta, $tv)
    {
        $this->lenta = $lenta;
        $this->display();
    }

    public function display()
    {
        echo $this->lenta;
    }
}

class TvWidget implements IObserver
{
    private $tv;

    function __construct($subject)
    {
        $subject->registerObserver($this);
    }

    public function update($twitter, $lenta, $tv)
    {
        $this->tv = $tv;
        $this->display();
    }

    public function display()
    {
        echo $this->tv;
    }
}

class TwitterWidget implements IObserver
{
    private $twitter;

    function __construct($subject)
    {
        $subject->registerObserver($this);
    }

    public function update($twitter, $lenta, $tv)
    {
        $this->twitter = $twitter;
        $this->display();
    }

    public function display()
    {
        echo $this->twitter;
    }
}

interface ISubject
{
    function registerObserver($observer);
    function removeObserver($observer);
    function notifyObserver();
}

class NewsAggregator implements ISubject
{
    private $observers;

    function __construct()
    {

    }

    public function registerObserver($observer)
    {
        $this->observers[] = $observer;
    }

    public function removeObserver($observer)
    {
        $deleteKey = -1;
        foreach ($this->observers as $key => $item) {
            if ($item === $observer) {
                $deleteKey = $key;
            }
        }

        if ($deleteKey > 0)
        {
            unset($this->observers[$deleteKey]);
        }
    }

    public function notifyObserver()
    {
        foreach ($this->observers as $observer) {
            // имитация передачи новых видов новостей
            $observer->update('Twitter', 'Lenta', 'Tv');
        }
    }

    public function newNewsAvailable()
    {
        $this->notifyObserver();
    }
}

$newsAggregator = new NewsAggregator();

$twitterWidget = new TwitterWidget($newsAggregator);
$lentaWidget = new LentaWidget($newsAggregator);
$tvWidget = new TvWidget($newsAggregator);

$newsAggregator->newNewsAvailable();
echo '<br />';
$newsAggregator->newNewsAvailable();
echo '<br />';