<?php
/**
 * This file is part of KarmaBot package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 16.03.2016 17:47
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Support\Property;

use Illuminate\Support\Str;

/**
 * Class Setters
 * @package App\Support
 */
trait Setters
{
    /**
     * @param $key
     * @return mixed
     * @throws \LogicException
     */
    public function __set($key, $value)
    {
        if (!property_exists($this, $key)) {
            throw new \LogicException(sprintf('Property %s::%s not defined', static::class, $key));
        }

        if (!method_exists($this, $this->getSetterMethod($key))) {
            throw new \LogicException(sprintf('Property %s::%s not writable', static::class, $key));
        }

        return $this->{$this->getSetterMethod($key)}($value);
    }

    /**
     * @param string $key
     * @return string
     */
    public function getSetterMethod(string $key)
    {
        return 'set' . Str::studly($key);
    }
}
