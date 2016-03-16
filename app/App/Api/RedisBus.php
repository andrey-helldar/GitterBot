<?php
/**
 * This file is part of KarmaBot package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 16.03.2016 19:14
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Api;


/**
 * Class RedisBus
 * @package App\Api
 */
class RedisBus implements Bus
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var \Redis|\Illuminate\Redis\Database
     */
    protected $driver;

    /**
     * RedisBus constructor.
     * @param string $service
     */
    public function __construct(string $service)
    {
        /** @var \Redis driver */
        $this->driver = app('redis');
        $this->name = $service;
    }

    /**
     * @param Event $event
     * @return Bus
     */
    public function publish(Event $event) : Bus
    {
        $this->driver->publish($this->getEventName($event->getName()), $event);

        return $this;
    }

    /**
     * @param array $eventNames
     * @param \Closure $callback
     * @return Bus
     */
    public function subscribe(array $eventNames, \Closure $callback) : Bus
    {
        $parsedNames = [];
        foreach ($eventNames as $eventName) {
            $parsedNames[] = $this->getEventName($eventName);
        }

        $this->driver->subscribe($parsedNames, $callback);

        return $this;
    }

    /**
     * @param string $eventName
     * @return string
     */
    private function getEventName(string $eventName) : string
    {
        return $this->name . ':' . $eventName;
    }
}
