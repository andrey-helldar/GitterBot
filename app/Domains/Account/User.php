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
namespace Domains\Account;

use Analogue\ORM\Entity;
use Analogue\ORM\EntityCollection;
use App\Jobs\AvatarSavingJob;
use Domains\Service\Service;
use Illuminate\Contracts\Queue\Queue;

/**
 * Class User
 * @package Domains\Account
 *
 *
 * @property string $login
 * @property string $password
 * @property string $email
 * @property string $avatar
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property EntityCollection $services
 *
 */
class User extends Entity
{
    /**
     * User constructor.
     * @param string $login
     * @param string|null $password
     * @param string|null $email
     */
    public function __construct(string $login, string $password = null, string $email = null)
    {
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->services = new EntityCollection();
    }

    /**
     * @param Service $service
     * @return $this
     */
    public function addService(Service $service)
    {
        $this->services->add($service);

        return $this;
    }

    /**
     * @param $avatar
     * @return $this
     */
    public function setAvatarAttribute($avatar)
    {
        app(Queue::class)->push(AvatarSavingJob::class, [
            'user'   => serialize($this),
            'avatar' => (string)$avatar,
        ]);

        return $this;
    }

    /**
     * @param $avatar
     * @return $this
     */
    public function getAvatarAttribute($avatar)
    {
       if ($avatar) {
           return $avatar;
       }

        return sprintf('https://github.com/identicons/%s.png', $this->login);
    }

    /**
     * @param $password
     * @return $this
     * @throws \RuntimeException
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = \Hash::make((string)$password);

        return $this;
    }
}
