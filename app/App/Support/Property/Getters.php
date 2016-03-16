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
 * Class Getters
 * @package App\Support
 */
trait Getters
{
    /**
     * @param $key
     * @return mixed
     * @throws \LogicException
     */
    public function __get($key)
    {
        if (!property_exists($this, $key)) {
            throw new \LogicException(sprintf('Property %s::%s not defined', static::class, $key));
        }

        if (!method_exists($this, $this->getGetterMethod($key))) {
            throw new \LogicException(sprintf('Property %s::%s not accessible', static::class, $key));
        }

        return $this->{$this->getGetterMethod($key)}($this->$key);
    }

    /**
     * @param string $key
     * @return string
     */
    public function getGetterMethod(string $key)
    {
        return 'get' . Str::studly($key);
    }
}
