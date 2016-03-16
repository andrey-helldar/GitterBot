<?php
/**
 * This file is part of KarmaBot package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 16.03.2016 18:00
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Exceptions;

/**
 * Class NotImplementedException
 * @package App\Exceptions
 */
class NotImplementedException extends \LogicException
{
    /**
     * NotImplementedException constructor.
     * @param null $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct($message = null, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message ?: 'Not implemented yet', $code, $previous);
    }
}
