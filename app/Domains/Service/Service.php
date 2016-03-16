<?php
/**
 * This file is part of KarmaBot package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 15.03.2016 16:14
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\Service;

/**
 * Class Service
 * @package Domains\Account
 */
class Service
{
    /**
     * Service constructor.
     * @param string $name
     * @param ServiceUser $user
     */
    public function __construct(string $name, ServiceUser $user)
    {
        $this->name = $name;
        $this->info = $user;
    }
}
