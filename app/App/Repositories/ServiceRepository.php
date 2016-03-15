<?php
/**
 * This file is part of KarmaBot package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 15.03.2016 17:40
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Repositories;

use Domains\Service\Service;
use Analogue\ORM\Repository;

/**
 * Class ServiceRepository
 * @package App\Repositories
 */
class ServiceRepository extends Repository
{
    /**
     * ServiceRepository constructor.
     */
    public function __construct()
    {
        parent::__construct(Service::class);
    }
}
