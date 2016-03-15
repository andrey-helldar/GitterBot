<?php
/**
 * This file is part of KarmaBot package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 15.03.2016 18:28
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Mappers;

use Analogue\ORM\ValueMap;

/**
 * Class ServiceUserMap
 * @package App\Mappers
 */
class ServiceUserMap extends ValueMap
{
    protected $attributes = ['id', 'login'];
}
