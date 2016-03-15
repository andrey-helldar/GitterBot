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

use Analogue\ORM\Entity;
use Domains\Account\User;

/**
 * Class Service
 * @package Domains\Account
 *
 * @property string $name
 * @property User $user
 * @property ServiceUser $info
 */
class Service extends Entity
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
