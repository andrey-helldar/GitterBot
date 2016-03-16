<?php
/**
 * This file is part of KarmaBot package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 15.03.2016 17:14
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\Message;

/**
 * Class Message
 * @package Domains\Message
 */
class Message
{
    /**
     * Message constructor.
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->text = $text;
    }
}
