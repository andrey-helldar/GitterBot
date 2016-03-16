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

use App\Exceptions\NotImplementedException;
use App\Support\Property\Getters;
use App\Support\Property\Setters;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation\Timestampable;

/**
 * Class User
 * @package Domains\Account
 * @ORM\Entity
 */
class User
{
    use Setters, Getters;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="string")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $login;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    protected $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $avatar;

    /**
     * @ORM\Column(name="remember_token", type="string", length=100, nullable=true)
     */
    protected $token;

    /**
     * @ORM\Column(type="datetime")
     * @Timestampable(on="create")
     */
    protected $created_at;

    /**
     * @ORM\Column(type="datetime")
     * @Timestampable(on="update")
     */
    protected $updated_at;

    /**
     * User constructor.
     * @param string $login
     * @param string|null $password
     * @param string|null $email
     */
    public function __construct(string $login, string $password = null, string $email = null)
    {
        $this->login = $login;
        $this->email = $email;

        if ($password) {
            $this->setPassword($password);
        }
    }

    /**
     * @param $password
     */
    public function setPassword($password)
    {
        $this->password = \Hash::make($password);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @return mixed
     */
    public function getPasswordHash()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param $avatar
     * @throws NotImplementedException
     */
    public function setAvatar($avatar)
    {
        throw new NotImplementedException();
    }
}
