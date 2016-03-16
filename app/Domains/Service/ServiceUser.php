<?php
/**
 * This file is part of KarmaBot package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 15.03.2016 18:27
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Domains\Service;

/**
 * Class ServiceUser
 * @package Domains\Service
 */
class ServiceUser
{
    /**
     * UserInfo constructor.
     * @param string $id
     * @param string $login
     */
    public function __construct(string $id, string $login)
    {
        $this->id = $id;
        $this->login = $login;
    }
}
