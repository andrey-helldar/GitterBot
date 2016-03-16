<?php
/**
 * This file is part of KarmaBot package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 16.03.2016 19:10
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Api;
use Illuminate\Contracts\Support\Arrayable;

/**
 * Class Event
 * @package App\Api
 */
class Event implements \JsonSerializable
{
    /**
     * @var int
     */
    private static $lastId = 0;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var mixed
     */
    protected $data;

    /**
     * @var string
     */
    protected $name;

    /**
     * Event constructor.
     * @param string $name
     * @param $data
     * @param int|null $id
     */
    public function __construct(string $name, $data, int $id = null)
    {
        $this->name = $name;
        $this->data = $data;

        $this->id = $id === null ? static::$lastId++ : $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $data = [];
        if ($this->data instanceof Arrayable) {
            $data = $this->data->toArray();
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'data' => $data
        ];
    }
}
