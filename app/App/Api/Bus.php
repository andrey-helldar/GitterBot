<?php
/**
 * This file is part of KarmaBot package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 16.03.2016 19:04
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Api;

/**
 * Interface Bus
 * @package App\Api
 */
interface Bus
{
    /**
     * Bus constructor.
     * @param string $service
     */
    public function __construct(string $service);

    /**
     * @param Event $event
     * @return mixed
     */
    public function publish(Event $event) : Bus;

    /**
     * @param array $eventNames
     * @param \Closure $callback
     * @return Bus
     */
    public function subscribe(array $eventNames, \Closure $callback) : Bus;
}
