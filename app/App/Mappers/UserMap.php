<?php
/**
 * This file is part of KarmaBot package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 15.03.2016 17:17
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Mappers;

use Domains\Account\User;
use Analogue\ORM\EntityMap;
use Domains\Service\Service;

/**
 * Class UserMap
 * @package App\Mappers
 */
class UserMap extends EntityMap
{
    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * @var string
     */
    protected $primaryKey = 'cuid';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @param User $user
     * @return \Analogue\ORM\Relationships\HasMany
     */
    public function services(User $user)
    {
        return $this->hasMany($user, Service::class, 'user_cuid', 'cuid');
    }
}
