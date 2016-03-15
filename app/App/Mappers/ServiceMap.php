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
namespace App\Mappers;

use Domains\Service\Service;
use Domains\Account\User;
use Analogue\ORM\EntityMap;
use Domains\Service\ServiceUser;

/**
 * Class ServiceMap
 * @package App\Mappers
 */
class ServiceMap extends EntityMap
{
    /**
     * @var string
     */
    protected $table = 'services';

    /**
     * @var string
     */
    protected $primaryKey = 'cuid';

    /**
     * @var array
     */
    protected $embeddables = [
        'info' => ServiceUser::class,
    ];

    /**
     * @param Service $service
     * @return \Analogue\ORM\Relationships\BelongsTo
     */
    public function user(Service $service)
    {
        return $this->belongsTo($service, User::class, 'user_cuid', 'cuid');
    }
}
