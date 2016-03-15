<?php
/**
 * This file is part of KarmaBot package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 15.03.2016 16:25
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Observers;

use Analogue\ORM\Entity;
use EndyJasmi\Cuid;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CuidObserver
 * @package App\Observers
 */
class CuidObserver
{
    /**
     * @var object
     */
    private $generator;

    /**
     * CuidObserver constructor.
     */
    public function __construct()
    {
        $this->generator = new class
        {
            /**
             * @return string
             */
            public function make() : string
            {
                return Cuid::make();
            }
        };
    }

    /**
     * @param Entity $entity
     */
    public function creating(Entity $entity)
    {
        if (!$entity->cuid) {
            $entity->cuid = $this->generator->cuid();
        }
    }
}
