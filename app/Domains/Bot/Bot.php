<?php
/**
 * This file is part of KarmaBot package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 16.03.2016 14:21
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\Bot;

use App\Api\Bus;
use Domains\Message\Message;

/**
 * Class Bot
 * @package Domains\Bot
 */
class Bot
{
    /**
     * @var array
     */
    private $channels = [];

    /**
     * @param Bus $bus
     * @return $this
     */
    public function attachBus(Bus $bus)
    {
        $this->channels[] = $bus;
        return $this;
    }
}
